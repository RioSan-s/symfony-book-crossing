<?php

namespace NonEfTech\BookCrossing\Controller;

use NonEfTech\BookCrossing\Entity\Point;

use NonEfTech\BookCrossing\Service\SearchPointsService;
use NonEfTech\BookCrossing\Service\SearchPointsService\PointsDto;
use NonEfTech\BookCrossing\Service\SearchPointsService\SearchPointsCriteria;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class GetPointsCollectionController extends AbstractController
{
    /**
     * Логер
     *
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * Сервис поиска пункта обмена
     *
     * @var SearchPointsService
     */
    private SearchPointsService $searchPointsService;



//
//    /**
//     * Валидатор данных
//     *
//     * @var CustomValidator
//     */
//    private CustomValidator $customValidator;

    /**
     * @param LoggerInterface       $logger
     * @param SearchPointsService   $searchPointsService
//     * @param CustomValidator       $customValidator
     */
    public function __construct(
        LoggerInterface $logger,
        SearchPointsService $searchPointsService
//        CustomValidator $customValidator
    )
    {
        $this->logger = $logger;
        $this->searchPointsService = $searchPointsService;
//        $this->customValidator = $customValidator;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $this->logger->info("Ветка points");
        $resultOfParamValidation =null;
//        $this->validateQueryParams($request);
        if (null === $resultOfParamValidation) {
            $params = array_merge($request->query->all(), $request->attributes->all());

            $foundPoint = $this->searchPointsService->search(
                (new SearchPointsCriteria())
                    ->setId(isset($params['id']) ? (int)$params['id'] : null)
                    ->setPhoneNumber($params['phoneNumber'] ?? null)
                    ->setAddress($params['address'] ?? null)
                    ->setStartTime($params['startTime'] ?? null)
                    ->setEndTime($params['endTime'] ?? null)
            );
            $result = $this->buildResult($foundPoint);
            $httpCode = $this->buildHttpCode($foundPoint);
        } else {
            $httpCode = 500;
            $result = [
                'status'  => 'fail',
                'message' => $resultOfParamValidation,
            ];
        }


        return $this->json($result,$httpCode);
    }
//
//    private function validateQueryParams(ServerRequestInterface $serverRequest): ?string
//    {
//        $params = array_merge($serverRequest->getQueryParams(), $serverRequest->getAttributes());
//        return $this->customValidator->startValidate($params, Point::class);
//    }

    protected function buildResult(array $foundPoints): array
    {
        $result = [];
        foreach ($foundPoints as $foundPoint) {
            $result[] = $this->serializePoints($foundPoint);
        }
        return $result;
    }

    final protected function serializePoints(PointsDto $pointsDto): array
    {
        return [
            'id'          => $pointsDto->getId(),
            'phoneNumber' => $pointsDto->getPhoneNumber(),
            'address'     => $pointsDto->getAddress(),
            'startTime'   => $pointsDto->getStartTime(),
            'endTime'     => $pointsDto->getEndTime(),
        ];
    }

    protected function buildHttpCode(array $foundPoints): int
    {
        return 200;
    }
}
