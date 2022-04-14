<?php

namespace NonEfTech\BookCrossing\Controller;


use NonEfTech\BookCrossing\Service\SearchBooksService;
use NonEfTech\BookCrossing\Service\SearchBooksService\BooksDto;
use NonEfTech\BookCrossing\Service\SearchBooksService\SearchBooksCriteria;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class GetBooksCollectionController extends AbstractController
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
     * @var SearchBooksService
     */
    private SearchBooksService $searchBooksService;

    /**
     * Сервис валидации
     *
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;


    /**
     * @param LoggerInterface $logger
     * @param SearchBooksService $searchBooksService
     * @param ValidatorInterface $validator
     */
    public function __construct(
        LoggerInterface $logger,
        SearchBooksService $searchBooksService,
        ValidatorInterface $validator
    ) {
        $this->logger = $logger;

        $this->searchBooksService = $searchBooksService;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $this->logger->info("Ветка books");
        $resultOfParamValidation = $this->booksValidator($request);

        if (null === $resultOfParamValidation) {
            $params = array_merge($request->query->all(), $request->attributes->all());

            $foundOfBook = $this->searchBooksService->search(
                (new SearchBooksCriteria())
                    ->setId(
                        isset($params['id']) ? (int)$params['id'] : null
                    )
                    ->setTitle($params['title'] ?? null)
                    ->setAuthor($params['author'] ?? null)
                    ->setNameOfPublicationHouse(
                        $params['ph_publishingHouse'] ?? null
                    )
                    ->setYearOfPublication(
                        $params['yearOfPublication']
                        ??
                        null
                    )
                    ->setPointId(
                        isset($params['point_id']) ? (int)$params['point_id'] : null
                    )
                    ->setPointPhoneNumber(
                        $params['point_phoneNumber']
                        ??
                        null
                    )
                    ->setPointCountry($params['point_country'] ?? null)
                    ->setPointCity($params['point_city'] ?? null)
                    ->setPointStreet($params['point_street'] ?? null)
                    ->setPointHome($params['point_home'] ?? null)
                    ->setPointFlat(isset($params['point_flat']) ? (int)$params['point_flat'] : null)
                    ->setPointStartTime($params['point_startTime'] ?? null)
                    ->setPointEndTime($params['point_endTime'] ?? null)
            );
            $result = $this->buildResult($foundOfBook);
            $httpCode = $this->buildHttpCode($foundOfBook);
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
     *
     * Валидация передаваемых данных
     * @param Request $serverRequest
     *
     * @return string|null
     * @throws \Exception
     */
    private function booksValidator(Request $serverRequest): ?string
    {

        $params = array_merge($serverRequest->query->all(), $serverRequest->attributes->all());
        $constraint = new Assert\Collection(
            [
                'allowExtraFields' => true,
                'allowMissingFields' => true,
                'fields' => [
                    'id' => [
                        new Assert\Type(['type' => 'string'], 'Некорректный тип данных id книги'),
                        new Assert\NotNull(['message' => 'Отсутствует заголовка книги']),
                        new Assert\NotBlank(['message' => 'Заголовок книги не должен быть пустой строкой']),
                    ],
                    'title' =>
                        [
                            new Assert\NotNull(['message' => 'Отсутствует заголовка книги']),
                            new Assert\NotBlank(['message' => 'Заголовок книги не должен быть пустой строкой']),
                            new Assert\Type(['type' => 'string'], 'Некорректный тип данных заголовка книги'),

                        ],
                    'author' =>
                        [
                            new Assert\NotNull(['message' => 'Отсутствует автор книги']),
                            new Assert\NotBlank(['message' => 'Автор книги не должен быть пустой строкой']),
                            new Assert\Type(['type' => 'string'], 'Некорректный тип данных автора книги'),
                        ],
                    'publishingHouse' =>
                        [
                            new Assert\NotNull(['message' => 'Отсутствует автор книги']),
                            new Assert\NotBlank(['message' => 'Автор книги не должен быть пустой строкой']),
                            new Assert\Type(['type' => 'string'], 'Некорректный тип данных издания автора книги'),
                        ],
                    'yearOfPublication' =>
                        [
                            new Assert\NotNull(['message' => 'Отсутствует год публикации книги']),
                            new Assert\NotBlank(['message' => 'год публикациине должен быть пустой строкой']),
                            new Assert\Type(['type' => 'string'], 'Некорректный тип данных года публикации книги'),
                            new Assert\Length(
                                [
                                    'min' => 10,
                                    'max' => 10,
                                    'exactMessage' => 'Длина поля год должна состоять из 4 символов',
                                ]
                            ),
                        ],
                    'point_id' => [
                        new Assert\Type(['type' => 'string'], 'Некорректный тип данных id пункта обмена'),
                        new Assert\NotNull(['message' => 'Отсутствует id пункта обмена книги']),
                        new Assert\NotBlank(['message' => 'id пункта обмена не должен быть пустой строкой']),
                    ],
                    'point_phoneNumber' =>
                        [
                            new Assert\NotNull(['message' => 'Отсутствует телефон пункта обмена']),
                            new Assert\NotBlank(['message' => 'Телефон пункта обмена должен быть пустой строкой']),
                            new Assert\Type(['type' => 'string'], 'Некорректный тип данных телефона пункта обмена'),
                            new Assert\Length(
                                [
                                    'min' => 18,
                                    'max' => 18,
                                    'exactMessage' => 'Некорректная длина номера телефона',
                                ]
                            ),
                        ],
                    'point_address' =>
                        [
                            new Assert\NotNull(['message' => 'Отсутствует адрес пункта обмена']),
                            new Assert\NotBlank(['message' => 'Адрес пункта обмена не должен быть пустой строкой']),
                            new Assert\Type(['type' => 'string'], 'Некорректный тип данных адреса пункта обмена'),
                        ],
                    'point_startTime' =>
                        [
                            new Assert\NotNull(['message' => 'Отсутствует время начала работы пункта обмена']),
                            new Assert\NotBlank(
                                ['message' => 'Время начала работы пункта обмена не должен быть пустой строкой']
                            ),
                            new Assert\Type(
                                ['type' => 'string'],
                                'Некорректный тип данных времени начала работы  пункта обмена'
                            ),
                            new Assert\Length(
                                [
                                    'min' => 5,
                                    'max' => 5,
                                    'exactMessage' => 'Некорректное время открытия пункта обмена',
                                ]
                            ),
                        ],
                    'point_endTime' =>
                        [
                            new Assert\NotNull(['message' => 'Отсутствует время закрытия пункта обмена']),
                            new Assert\NotBlank(
                                ['message' => 'Время закрытия пункта обмена не должен быть пустой строкой']
                            ),
                            new Assert\Type(
                                ['type' => 'string'],
                                'Некорректный тип данных закрытия работы  пункта обмена'
                            ),
                            new Assert\Length(
                                [
                                    'min' => 5,
                                    'max' => 5,
                                    'exactMessage' => 'Некорректное время закрытия пункта обмена',
                                ]
                            ),
                        ]
                ],
            ],
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

    protected function buildResult(array $foundOfBooks): array
    {
        $result = [];
        foreach ($foundOfBooks as $foundOfBook) {
            $result[] = $this->serializeBooks($foundOfBook);
        }
        return $result;
    }

    final protected function serializeBooks(BooksDto $booksDto): array
    {
        $jsonData = [
            'id' => $booksDto->getId(),
            'title' => $booksDto->getTitle(),
            'author' => $booksDto->getAuthor(),
            'publishingHouse' => $booksDto->getPublishingHouse()->getNameOfPublicationHouse(),
            'yearOfPublication' => $booksDto->getYearOfPublication(),
        ];

        $pointsDto = $booksDto->getPoint();
        $jsonData['point'] = [
            'id' => $pointsDto->getId(),
            'phoneNumber' => $pointsDto->getPhoneNumber(),
            'address' => "{$pointsDto->getCountry()}, г. {$pointsDto->getCity()}, {$pointsDto->getStreet()} ул., д. {$pointsDto->getHome()} кв.{$pointsDto->getFlat()}",
            'startTime' => $pointsDto->getStartTime(),
            'endTime' => $pointsDto->getEndTime(),

        ];
        return $jsonData;
    }

    protected function buildHttpCode(array $foundOfBooks): int
    {
        return 200;
    }
}
