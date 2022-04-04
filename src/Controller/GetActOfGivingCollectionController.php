<?php

namespace NonEfTech\BookCrossing\Controller;

use NonEfTech\BookCrossing\Service\SearchActOfGivingService;
use NonEfTech\BookCrossing\Service\SearchActOfGivingService\ActOfGivingDto;
use NonEfTech\BookCrossing\Service\SearchActOfGivingService\SearchActOfGivingCriteria;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetActOfGivingCollectionController extends AbstractController
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
     * @var SearchActOfGivingService
     */
    private SearchActOfGivingService $searchActOfGivingService;



    /**
     * @param LoggerInterface $logger
     * @param SearchActOfGivingService $searchActOfGivingService
     */
    public function __construct(
        LoggerInterface $logger,
        SearchActOfGivingService $searchActOfGivingService
    ) {
        $this->logger = $logger;
        $this->searchActOfGivingService = $searchActOfGivingService;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $this->logger->info("Ветка ActOfGiving");
        $resultOfParamValidation = null;
//        $this->validateQueryParams($request);

        if (null === $resultOfParamValidation) {
            $params = array_merge($request->query->all(), $request->attributes->all());

            $foundActOfGivings = $this->searchActOfGivingService->search(
                (
                new SearchActOfGivingCriteria())
                    ->setId(
                        isset($params['id']) ? (int)$params['id'] : null
                    )
                    ->setBookId(
                        isset($params['book_id']) ? (int)$params['book_id'] : null
                    )
                    ->setTitle($params['book_title'] ?? null)
                    ->setAuthor($params['book_author'] ?? null)
                    ->setPublishingHouse(
                        $params['book_publishingHouse']
                        ??
                        null
                    )
                    ->setYearOfPublication(
                        $params['book_yearOfPublication']
                        ??
                        null
                    )
                    ->setPointId(
                        isset($params['book_point_id']) ? (int)$params['book_point_id'] : null
                    )
                    ->setPointPhoneNumber(
                        $params['book_point_phoneNumber']
                        ??
                        null
                    )
                    ->setPointAddress(
                        $params['book_point_address']
                        ??
                        null
                    )
                    ->setPointStartTime(
                        $params['book_point_startTime']
                        ??
                        null
                    )
                    ->setPointEndTime(
                        $params['book_point_endTime']
                        ??
                        null
                    )
                    ->setCount($params['count'] ?? null)
                    ->setParticipantId(
                        isset($params['participant_id']) ? (int)$params['participant_id'] : null
                    )
                    ->setFio(
                        $params['participant_fio'] ?? null
                    )
                    ->setPhoneNumber(
                        $params['participant_phoneNumber']
                        ??
                        null
                    )
                    ->setDateOfBirth(
                        $params['participant_dateOfBirth']
                        ??
                        null
                    )
                    ->setEmail(
                        $params['participant_email']
                        ??
                        null
                    )
            );
            $result = $this->buildResult($foundActOfGivings);
            $httpCode = $this->buildHttpCode($foundActOfGivings);
        } else {
            $httpCode = 500;
            $result = [
                'status' => 'fail',
                'message' => $resultOfParamValidation,
            ];
        }


        return $this->json($result,$httpCode);
    }

//    /**
//     * Валидация данных
//     *
//     * @param ServerRequestInterface $serverRequest
//     *
//     * @return string|null
//     * @noinspection DuplicatedCode
//     */
//    private function validateQueryParams(ServerRequestInterface $serverRequest): ?string
//    {
//        $paramForValidations = [
//            'id' => 'Incorrect id',
//            'count' => 'Incorrect count',
//            'book_id' => 'Incorrect book_id',
//            'book_title' => 'Incorrect book_title',
//            'book_author' => 'Incorrect book_author',
//            'book_publishingHouse' => 'Incorrect book_publishingHouse',
//            'book_yearOfPublication' => 'Incorrect book_yearOfPublication',
//            'book_point_id' => 'Incorrect book_point_id',
//            'book_point_phoneNumber' => 'Incorrect book_point_phoneNumber',
//            'book_point_address' => 'Incorrect book_point_address',
//            'book_point_startTime' => 'Incorrect book_point_startTime',
//            'book_point_endTime' => 'Incorrect book_point_endTime',
//            'participant_id' => 'Incorrect participant_id',
//            'participant_fio' => 'Incorrect participant_fio',
//            'participant_phoneNumber' => 'Incorrect participant_phoneNumber',
//            'participant_dateOfBirth' => 'Incorrect participant_dateOfBirth',
//            'participant_email' => 'Incorrect participant_email',
//        ];
//        $params = array_merge($serverRequest->getQueryParams(), $serverRequest->getAttributes());
//        return Assert::arrayElementsIsString($paramForValidations, $params);
//    }

    protected function buildResult(array $foundActOfGivings): array
    {
        $result = [];
        foreach ($foundActOfGivings as $foundActOfGiving) {
            $result[] = $this->serializeActOfGiving($foundActOfGiving);
        }
        return $result;
    }

    protected function serializeActOfGiving(ActOfGivingDto $actOfGivingDto): array
    {
        $booksDto = $actOfGivingDto->getBook();
        $jsonData['book'] = [
            'id' => $booksDto->getId(),
            'title' => $booksDto->getTitle(),
            'author' => $booksDto->getAuthor(),
            'publishingHouse' => $booksDto->getPublishingHouse(),
            'yearOfPublication' => $booksDto->getYearOfPublication(),
        ];

        $pointsDto = $booksDto->getPoint();
        $jsonData['book']['point'] = [
            'id' => $pointsDto->getId(),
            'phoneNumber' => $pointsDto->getPhoneNumber(),
            'address' => $pointsDto->getAddress(),
            'startTime' => $pointsDto->getStartTime(),
            'endTime' => $pointsDto->getEndTime(),

        ];
        $participantsDto = $actOfGivingDto->getParticipant();
        $jsonData['participant'] =
            [
                'id' => $participantsDto->getId(),
                'fio' => $participantsDto->getFio(),
                'phoneNumber' => $participantsDto->getPhoneNumber(),
                'dateOfBirth' => $participantsDto->getDateOfBirth()->format('d.m.Y'),
                'email' => $participantsDto->getEmail(),
            ];
        return [
            'id' => $actOfGivingDto->getId(),
            'book' => $jsonData['book'],
            'count' => $actOfGivingDto->getCount(),
            'participant' => $jsonData['participant'],
        ];
    }

    protected function buildHttpCode(array $foundActOfGivings): int
    {
        return 200;
    }
}
