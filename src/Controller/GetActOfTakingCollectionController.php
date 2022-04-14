<?php

namespace NonEfTech\BookCrossing\Controller;


use NonEfTech\BookCrossing\Service\SearchActOfTakingService;
use NonEfTech\BookCrossing\Service\SearchActOfTakingService\ActOfTakingDto;
use NonEfTech\BookCrossing\Service\SearchActOfTakingService\SearchActOfTakingCriteria;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class GetActOfTakingCollectionController extends AbstractController
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
     * @var SearchActOfTakingService
     */
    private SearchActOfTakingService $searchActOfTakingService;

    /**
     * Сервис валидации
     *
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;


    /**
     * @param LoggerInterface $logger
     * @param SearchActOfTakingService $searchActOfTakingService
     * @param ValidatorInterface $validator
     */
    public function __construct(
        LoggerInterface $logger,
        SearchActOfTakingService $searchActOfTakingService,
        ValidatorInterface $validator
    ) {
        $this->logger = $logger;
        $this->searchActOfTakingService = $searchActOfTakingService;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $this->logger->info("Ветка ActOfTaking");
        $resultOfParamValidation = $this->validateQueryParams($request);


        if (null === $resultOfParamValidation) {
            $params = array_merge($request->query->all(), $request->attributes->all());

            $foundActOfTakings = $this->searchActOfTakingService->search(
                (
                new SearchActOfTakingCriteria())
                    ->setId(
                        isset($params['id']) ? (int)$params['id'] : null
                    )
                    ->setBookId(
                        isset($params['book_id']) ? (int)$params['book_id'] : null
                    )
                    ->setTitle($params['book_title'] ?? null)
                    ->setAuthor($params['book_author'] ?? null)
                    ->setPhNameOfPublicationHouse(
                        $params['ph_nameOfPublicationHouse']
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
                    ->setPointCountry($params['book_point_country'] ?? null)
                    ->setPointCity($params['book_point_city'] ?? null)
                    ->setPointStreet($params['book_point_street'] ?? null)
                    ->setPointHome($params['book_point_home'] ?? null)
                    ->setPointFlat(isset($params['book_point_flat']) ? (int)$params['book_point_flat'] : null)
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
                    ->setCount(
                        isset($params['count']) ? (int)$params['count'] : null
                    )
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
            $result = $this->buildResult($foundActOfTakings);
            $httpCode = $this->buildHttpCode($foundActOfTakings);
            //$result =
            // $this->searchActOfTaking($actOfTakingsIdEntity['path'],$actOfTakingsIdEntity['data'],$httpRequest);
        } else {
            $httpCode = 500;
            $result = [
                'status' => 'fail',
                'message' => $resultOfParamValidation,
            ];
        }


        return $this->json($result, $httpCode);
    }

    /**
     * Валидация данных
     *
     * @param Request $serverRequest
     *
     * @return string|null
     * @noinspection DuplicatedCode
     */
    private function validateQueryParams(Request $serverRequest): ?string
    {
        $params = array_merge($serverRequest->query->all(), $serverRequest->attributes->all());
        $constraint =
            new Assert\Collection(
                [
                    'allowExtraFields' => true,
                    'allowMissingFields' => false,
                    'fields' => [
                        'id' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect id']),
                                ]
                            ),
                        'count' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect count']),
                                ]
                            ),
                        'book_id' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect book_id']),
                                ]
                            ),
                        'book_title' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect book_title']),
                                ]
                            ),
                        'book_author' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect book_author']),
                                ]
                            ),
                        'ph_nameOfPublicationHouse' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect book_publishingHouse']
                                    ),
                                ]
                            ),
                        'book_yearOfPublication' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(
                                        ['type' => 'string', 'message' => 'Incorrect book_yearOfPublication']
                                    ),
                                ]
                            ),
                        'book_point_id' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect book_point_id']),
                                ]
                            ),
                        'book_point_phoneNumber' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(
                                        ['type' => 'string', 'message' => 'Incorrect book_point_phoneNumber']
                                    ),
                                ]
                            ),
                        'book_point_address' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect book_point_address']),
                                ]
                            ),
                        'book_point_startTime' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect book_point_startTime']
                                    ),
                                ]
                            ),
                        'book_point_endTime' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect book_point_endTime']),
                                ]
                            ),
                        'participant_id' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect participant_id']),
                                ]
                            ),
                        'participant_fio' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect participant_fio']),
                                ]
                            ),
                        'participant_phoneNumber' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(
                                        ['type' => 'string', 'message' => 'Incorrect participant_phoneNumber']
                                    ),
                                ]
                            ),
                        'participant_dateOfBirth' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(
                                        ['type' => 'string', 'message' => 'Incorrect participant_dateOfBirth']
                                    ),
                                ]
                            ),
                        'participant_email' =>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Incorrect participant_email']),
                                ]
                            ),
                    ],
                ]
            );

        $errors = $this->validator->validate($params, $constraint);
        $errStrCollection = array_map(
            static function ($v) {
                return $v->getMessage();
            },
            $errors->getIterator()
                ->getArrayCopy()
        );
        return count($errStrCollection) > 0 ? implode(',', $errStrCollection) : null;
    }

    protected function buildResult(array $foundActOfTakings): array
    {
        $result = [];
        foreach ($foundActOfTakings as $foundActOfTaking) {
            $result[] = $this->serializeActOfTaking($foundActOfTaking);
        }
        return $result;
    }

    protected function serializeActOfTaking(ActOfTakingDto $actOfTakingDto): array
    {

        $booksDto = $actOfTakingDto->getBook();
        $jsonData['book'] = [
            'id' => $booksDto->getId(),
            'title' => $booksDto->getTitle(),
            'author' => $booksDto->getAuthor(),
            'publishingHouse' => $booksDto->getPublishingHouse()->getNameOfPublicationHouse(),
            'yearOfPublication' => $booksDto->getYearOfPublication(),
        ];

        $pointsDto = $booksDto->getPoint();
        $jsonData['book']['point'] = [
            'id' => $pointsDto->getId(),
            'phoneNumber' => $pointsDto->getPhoneNumber(),
            'address' => "{$pointsDto->getCountry()}, г. {$pointsDto->getCity()}, {$pointsDto->getStreet()} ул., д. {$pointsDto->getHome()} кв.{$pointsDto->getFlat()}",
            'startTime' => $pointsDto->getStartTime(),
            'endTime' => $pointsDto->getEndTime(),

        ];
        $participantsDto = $actOfTakingDto->getParticipant();
        $jsonData['participant'] =
            [
                'id' => $participantsDto->getId(),
                'fio' => $participantsDto->getFio(),
                'phoneNumber' => $participantsDto->getPhoneNumber(),
                'dateOfBirth' => $participantsDto->getDateOfBirth()->format('d.m.Y'),
                'email' => $participantsDto->getEmail(),
            ];
        return [
            'id' => $actOfTakingDto->getId(),
            'book' => $jsonData['book'],
            'count' => $actOfTakingDto->getCount(),
            'participant' => $jsonData['participant'],
        ];
    }

    protected function buildHttpCode(array $foundActOfTakings): int
    {
        return 200;
    }
}
