<?php

namespace NonEfTech\BookCrossing\Controller;

use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use NonEfTech\BookCrossing\Service\ArrivalNewBlackListMemberService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

class RegisterBlackListMemberController extends AbstractController
{
    /**
     * Сервис для регистрации нового члена blacklist
     * @var ArrivalNewBlackListMemberService
     */
    private ArrivalNewBlackListMemberService $arrivalNewBlackListMemberService;

    /**
     * Соединение с бд
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * Сервис валидации
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;

    /**
     * @param ArrivalNewBlackListMemberService $arrivalNewBlackListMemberService
     * @param EntityManagerInterface $em
     * @param ValidatorInterface $validator
     */
    public function __construct(
        ArrivalNewBlackListMemberService $arrivalNewBlackListMemberService,
        EntityManagerInterface $em,
        ValidatorInterface $validator
    ) {
        $this->arrivalNewBlackListMemberService = $arrivalNewBlackListMemberService;
        $this->em = $em;
        $this->validator = $validator;
    }

    public function __invoke(Request $request): Response
    {
        try {
            $this->em->beginTransaction();
            $requestData = json_decode($request->getContent(), true, 10, JSON_THROW_ON_ERROR);
            $validationResult = $this->validateData($requestData);

            if (0 === count($validationResult)) {
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
        return $this->json($jsonData, $httpCode);
    }

    private function validateData(array $requestData): array
    {

        $constraint
            =
            [
                new Assert\Type(['type' => 'array', 'message' => 'Данные о члене blacklist не являются массивом']),
                new Assert\Collection(
                    [
                        'allowExtraFields' => true,
                        'allowMissingFields' => false,
                        'missingFieldsMessage' => 'Отсутствует обязательное поле: {{ field }}',
                        'extraFieldsMessage' => 'Есть лишние поля: {{ field }}',
                        'fields' =>
                            [
                                'description' => new Assert\Type(
                                    ['type' => 'string', 'message' => 'incorrect blacklist description']
                                ),
                                'participant' => new Assert\Type(
                                    ['type' => 'int', 'message' => 'incorrect blacklist participant']
                                ),
                                'date' => new Assert\Type(['type' => 'string', 'message' => 'incorrect blacklist date']
                                ),
                                'status' => new Assert\Type(
                                    ['type' => 'string', 'message' => 'incorrect blacklist status']
                                ),

                            ]
                    ]

                )
            ];
        $errors = $this->validator->validate($requestData, $constraint);
        $errStrCollection = array_map(
            static function ($v) {
                return $v->getMessage();
            },
            $errors->getIterator()
                ->getArrayCopy()
        );
        return $errStrCollection;
    }

    /**
     * Запуск сервиса
     * @param array $requestData
     * @return ArrivalNewBlackListMemberService\ResultRegisterBlackListMemberDto
     */
    private function runService(array $requestData): ArrivalNewBlackListMemberService\ResultRegisterBlackListMemberDto
    {
        $requestDto = new ArrivalNewBlackListMemberService\NewBlackListMemberDto(
            $requestData['description'],
            $requestData['participant'],
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $requestData['date']),
            $requestData['status']
        );
        return $this->arrivalNewBlackListMemberService->registerNewBlackListMember($requestDto);
    }

    private function buildJsonData(ArrivalNewBlackListMemberService\ResultRegisterBlackListMemberDto $responseDto
    ): array {
        return
            [
                'participantFIO' => $responseDto->getParticipant(),
                'status' => $responseDto->getStatus(),
                'description' => $responseDto->getDescription(),
                'date' => $responseDto->getDate()
            ];
    }


}