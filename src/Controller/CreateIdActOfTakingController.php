<?php

namespace NonEfTech\BookCrossing\Controller;

use Doctrine\ORM\EntityManagerInterface;

use NonEfTech\BookCrossing\Service\ArrivalNewActOfTakingService;
use NonEfTech\BookCrossing\Service\ArrivalNewActOfTakingService\NewActOfTakingDto;
use NonEfTech\BookCrossing\Service\ArrivalNewActOfTakingService\ResultRegisteringActOfTakingDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use Throwable;

/**
 * Контроллер реализующий логику обработки запроса добавления новых актов взятия
 */
class CreateIdActOfTakingController extends AbstractController
{
    /**
     * Сервис для регистрации новых актов взятия
     *
     * @var ArrivalNewActOfTakingService
     */
    private ArrivalNewActOfTakingService $arrivalNewActOfTakingService;

    /**
     * Соединение с бд
     *
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;


    /**
     * Сервис валидации
     *
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;


    /**
     * @param ArrivalNewActOfTakingService $arrivalNewActOfTakingService
     * @param EntityManagerInterface $em
     * @param ValidatorInterface $validator
     */
    public function __construct(
        ArrivalNewActOfTakingService $arrivalNewActOfTakingService,
        EntityManagerInterface $em,
        ValidatorInterface $validator
    ) {
        $this->arrivalNewActOfTakingService = $arrivalNewActOfTakingService;
        $this->em = $em;
        $this->validator = $validator;
    }


    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        try {
            $this->em->beginTransaction();
            $requestData = json_decode($request->getContent(), true, 10, JSON_THROW_ON_ERROR);
            $validationResult = $this->validateData($requestData);
            if (0 === count($validationResult)) {
                //СОздано дто с входными данными и запущен сервис
                $responseDto = $this->runService($requestData);
                $httpCode = 201;
                $jsonData = $this->buildJsonData($responseDto);
            } else {
                $httpCode = 400;
                $jsonData = ['status' => 'fail', 'message' => implode('. ', $validationResult)];
            }
            $this->em->flush();
            $this->em->commit();
        } catch (Throwable $e) {
            $this->em->rollBack();
            $httpCode = 500;
            $jsonData = ['status' => 'fail', 'message' => $e->getMessage()];
        }


        return $this->json(
            $jsonData,
            $httpCode
        );
    }

    /**
     * Валидация данных
     *
     * @param $requestData
     *
     * @return array
     * @throws \Exception
     */
    private function validateData($requestData):array
    {
        $constraint = [
            new Assert\Type(['type' => 'array', 'message' => 'Данные о акте взятия не являются массивом']),
            new Assert\Collection(
                [
                    'allowExtraFields' => false,
                    'allowMissingFields' => false,
                    'missingFieldsMessage' => 'Отсутствует обязательное поле: {{ field }}',
                    'extraFieldsMessage' => 'Есть лишние поля: {{ field }}',
                    'fields' => [
                        'book_id' => [
                            new Assert\Type(['type' => 'int', 'message' => 'id книги должно быть числом']),
                            new Assert\NotNull(
                                [
                                    'message' => 'id книги не может отсутствовать',
                                ]
                            ),
                            new Assert\Positive(['message' => 'id книги не может быть меньше нуля']),
                        ],
                        'count' =>
                            [
                                new Assert\Type(['type' => 'int', 'message' => 'Количество книг должно быть числом']),
                                new Assert\NotNull(
                                    [
                                        'message' => 'Количество книг не может отсутствовать',
                                    ]
                                ),
                                new Assert\Positive(['message' => 'Количество книг не может быть меньше нуля']),
                            ],
                        'participant_id' =>
                            [
                                new Assert\Type(['type' => 'int', 'message' => 'id участника обмена должно быть числом']
                                ),
                                new Assert\NotNull(
                                    [
                                        'message' => 'id участника обмена не может отсутствовать',
                                    ]
                                ),
                                new Assert\Positive(['message' => 'id участника обмена не может быть меньше нуля']),
                            ]
                    ]
                ]
            ),
        ];

        $errors = $this->validator->validate($requestData, $constraint);
        return array_map(static function ($v) {
            return $v->getMessage();
        }, $errors->getIterator()->getArrayCopy());
    }

    /**
     * Запуск сервиса
     *
     * @param array $requestData
     *
     * @return ResultRegisteringActOfTakingDto
     */
    private function runService(array $requestData): ResultRegisteringActOfTakingDto
    {
        $requestDto = new NewActOfTakingDto(
            $requestData['book_id'],
            $requestData['count'],
            $requestData['participant_id'],
        );
        return $this->arrivalNewActOfTakingService->registerActOfTaking($requestDto);
    }

    /**
     * Формирует данные для ответа на основе дто с результатами работы сервиса
     *
     * @param ResultRegisteringActOfTakingDto $responseDto
     *
     * @return array
     */
    private function buildJsonData(ResultRegisteringActOfTakingDto $responseDto): array
    {
        return [
            'id' => $responseDto->getId(),
        ];
    }
}
