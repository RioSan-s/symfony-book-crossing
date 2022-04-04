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
     * @param ArrivalNewActOfTakingService $arrivalNewActOfTakingService
     * @param EntityManagerInterface $em
     */
    public function __construct(
        ArrivalNewActOfTakingService $arrivalNewActOfTakingService,
        EntityManagerInterface $em
    )
    {
        $this->arrivalNewActOfTakingService = $arrivalNewActOfTakingService;
        $this->em = $em;
    }


    /**
     * @Route("/actOfTaking/id", name="act_of_register",methods={"POST"})
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
     */
    private function validateData($requestData)
    {
        $err = [];
        if (false === is_array($requestData)) {
            $err[] = 'Данные о акте взятия не являются массивом';
        } else {
            if (false === array_key_exists('book_id', $requestData)) {
                $err[] = 'Отсутствует информация о книге';
            } elseif (null === $requestData['book_id']) {
                $err[] = 'id книги не должно иметь значение null';
            } elseif (false === is_int($requestData['book_id'])) {
                $err[] = 'id книги должно быть числом ';
            }

            if (false === array_key_exists('count', $requestData)) {
                $err[] = 'Отсутствует информация о количестве книг';
            } elseif (null === $requestData['count']) {
                $err[] = 'Количество книг не должно иметь значение null';
            } elseif (false === is_int($requestData['count'])) {
                $err[] = 'Количество книг должно быть числом ';
            } elseif ($requestData['count'] < 0) {
                $err[] = 'Количество книг не может быть меньше нуля';
            }

            if (false === array_key_exists('participant_id', $requestData)) {
                $err[] = 'Отсутствует информация о пользователе';
            } elseif (null === $requestData['participant_id']) {
                $err[] = 'id пользователя не должно иметь значение null';
            } elseif (false === is_int($requestData['participant_id'])) {
                $err[] = 'id пользователя должно быть числом ';
            }
        }
        return $err;
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
