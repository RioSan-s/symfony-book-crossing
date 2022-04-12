<?php

namespace NonEfTech\BookCrossing\Controller;

use NonEfTech\BookCrossing\Service\SearchPublicationHouseService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetPublicationHouseController extends AbstractController
{

    private LoggerInterface $logger;

    private SearchPublicationHouseService $searchPublicationHouseService;

    /**
     * @param LoggerInterface               $logger
     * @param SearchPublicationHouseService $searchPublicationHouseService
     */
    public function __construct(LoggerInterface $logger, SearchPublicationHouseService $searchPublicationHouseService)
    {
        $this->logger = $logger;
        $this->searchPublicationHouseService = $searchPublicationHouseService;
    }

    public function __invoke(Request $serverRequest):Response
    {
        $this->logger->info("Ветка Издательств");
        $params = array_merge(
            $serverRequest->query->all(),
            $serverRequest->attributes->all()
        );

        $foundPublicationHouses =
            $this->searchPublicationHouseService->search(
                (new SearchPublicationHouseService\SearchPublicationHouseCriteria())
                ->setId( isset($params['id']) ? (int)$params['id'] : null)
                ->setNameOfPublicationHouse($params['name_of_publication_house'] ?? null)
                ->setYearOfCreation($params['year_of_creation'] ?? null)
                ->setOwnerOfPublicationHouse($params['owner_of_publication_house'] ?? null)
            );

        $result = $this->buildResult($foundPublicationHouses);
        $httpCode = 200;

        return
        $this->json(
          $result,
          $httpCode
        );
    }

    /**
     * Подготавливает данные для ответа
     *
     * @param array $foundTextDocuments
     *
     * @return array
     */
    protected function buildResult(array $foundPublicationHouses): array
    {
        $result = [];
        foreach ($foundPublicationHouses as $foundPublicationHouse) {
            $result[] = $this->serializeTextDocument($foundPublicationHouse);
        }
        return $result;
    }

    private function serializeTextDocument( SearchPublicationHouseService\PublicationHouseDto $dto)
    :array
    {
        return
        [
            'id'=>$dto->getId(),
            'nameOfPublicationHouse'=>$dto->getNameOfPublicationHouse(),
            'yearOfCreation'=>(int)($dto->getYearOfCreation()->format('Y')),
            'ownerOfPublicationHouse'=>$dto->getOwnerOfPublicationHouse(),
        ];
    }


}