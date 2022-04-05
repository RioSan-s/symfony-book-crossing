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
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;


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

    /**
     * Сервис валидации
     *
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;


//
//    /**
//     * Валидатор данных
//     *
//     * @var CustomValidator
//     */
//    private CustomValidator $customValidator;

    /**
     * @param LoggerInterface $logger
     * @param SearchPointsService $searchPointsService
     * @param ValidatorInterface $validator
     */
    public function __construct(
        LoggerInterface $logger,
        SearchPointsService $searchPointsService,
        ValidatorInterface $validator
    ) {
        $this->logger = $logger;
        $this->searchPointsService = $searchPointsService;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $this->logger->info("Ветка points");
        $resultOfParamValidation = $this->validateQueryParams($request);
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
                'status' => 'fail',
                'message' => $resultOfParamValidation,
            ];
        }


        return $this->json($result, $httpCode);
    }

    private function validateQueryParams(Request $serverRequest): ?string
    {
        $params = array_merge($serverRequest->query->all(), $serverRequest->attributes->all());
        $constraint =
            new Assert\Collection(
                [
                    'allowExtraFields' => true,
                    'allowMissingFields' => false,
                    'fields' => [
                        'id'=>
                        new Assert\Optional(
                            [
                                new Assert\Type(['type' => 'string', 'message' => 'Неверный тип данных идентификатора пункта обмена']),
                            ]
                        ),
                        'phoneNumber'=>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Неверный тип данных номера телефона пункта обмена']),
                                ]
                            ),
                        'address'=>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Неверный тип данных адреса пункта обмена']),
                                ]
                            ),
                        'startTime'=>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Неверный тип данных времени начала работы пункта обмена']),
                                ]
                            ),
                        'endTime'=>
                            new Assert\Optional(
                                [
                                    new Assert\Type(['type' => 'string', 'message' => 'Неверный тип данных времени завершения работы пункта обмена']),
                                ]
                            ),
                    ]

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
            'id' => $pointsDto->getId(),
            'phoneNumber' => $pointsDto->getPhoneNumber(),
            'address' => $pointsDto->getAddress(),
            'startTime' => $pointsDto->getStartTime(),
            'endTime' => $pointsDto->getEndTime(),
        ];
    }

    protected function buildHttpCode(array $foundPoints): int
    {
        return 200;
    }
}
