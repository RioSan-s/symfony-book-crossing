<?php

namespace NonEfTech\BookCrossing\Controller;

use Doctrine\ORM\EntityManagerInterface;
use NonEfTech\BookCrossing\Exception\RuntimeException;

use NonEfTech\BookCrossing\Service\ArrivalNewActOfTakingService;
use NonEfTech\BookCrossing\Service\ArrivalNewActOfTakingService\NewActOfTakingDto;
use NonEfTech\BookCrossing\Service\SearchActOfTakingService;
use NonEfTech\BookCrossing\Service\SearchActOfTakingService\SearchActOfTakingCriteria;
use NonEfTech\BookCrossing\Service\SearchBooksService;
use NonEfTech\BookCrossing\Service\SearchBooksService\SearchBooksCriteria;
use NonEfTech\BookCrossing\Service\SearchParticipantsService;
use NonEfTech\BookCrossing\Service\SearchParticipantsService\SearchParticipantsCriteria;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ActOfTakingAdministrationController extends AbstractController
{
    /**
     * Логер
     *
     * @var LoggerInterface
     */
    private LoggerInterface $logger;


    /**
     * Сервис поиска актов взятия
     *
     * @var SearchActOfTakingService
     */
    private SearchActOfTakingService $actOfTakingService;


    /**
     * Сервис поиска книг
     *
     * @var SearchBooksService
     */
    private SearchBooksService $booksService;

    /**
     * Сервис поиска пользователей
     *
     * @var SearchParticipantsService
     */
    private SearchParticipantsService $participantsService;

    /**
     * Соединение с бд
     *
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;


    /**
     * Сервис регистрации нового акта взятия
     *
     * @var ArrivalNewActOfTakingService
     */
    private ArrivalNewActOfTakingService $arrivalNewActOfTakingService;


    /**
     * @param LoggerInterface $logger
     * @param SearchActOfTakingService $actOfTakingService
     * @param SearchBooksService $booksService
     * @param SearchParticipantsService $participantsService
     * @param ArrivalNewActOfTakingService $arrivalNewActOfTakingService
     * @param EntityManagerInterface $em
     */
    public function __construct(
        LoggerInterface $logger,
        SearchActOfTakingService $actOfTakingService,

        SearchBooksService $booksService,
        SearchParticipantsService $participantsService,
        ArrivalNewActOfTakingService $arrivalNewActOfTakingService,
        EntityManagerInterface $em
    ) {
        $this->logger = $logger;
        $this->actOfTakingService = $actOfTakingService;
        $this->booksService = $booksService;
        $this->participantsService = $participantsService;
        $this->arrivalNewActOfTakingService = $arrivalNewActOfTakingService;
        $this->em = $em;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        try {
            $this->logger->info('run TextDocumentAdministrationController::__invoke');

//            if (false === $this->httpAuthProvider->isAuth()) {
//                return $this->httpAuthProvider->doAuth($request->getUri());
//            }

            $resultCreatingActOfTaking = [];
            if ('POST' === $request->getMethod()) {
                $resultCreatingActOfTaking = $this->creationActOfTaking($request);
            }
            $dtoActOfTakingCollection = $this->actOfTakingService->search(new SearchActOfTakingCriteria());
            $dtoBooksCollection = $this->booksService->search(new SearchBooksCriteria());
            $dtoParticipantsCollection = $this->participantsService->search(new SearchParticipantsCriteria());

            $viewData = [
                'actOfTaking' => $dtoActOfTakingCollection,
                'books' => $dtoBooksCollection,
                'participants' => $dtoParticipantsCollection,
                'formValidationResults' => $resultCreatingActOfTaking,
            ];
            $template = 'actOfTaking.administration.twig';
            $httpCode = 200;
            $context = array_merge($viewData, $resultCreatingActOfTaking);
        } catch (Throwable $e) {
            $httpCode = 500;
            $template = 'errors.twig';
            $context = [
                'errors' => [
                    $e->getMessage(),
                ],
            ];
        }

        $response = $this->render(
            $template,
            $context
        );
        $response->setStatusCode($httpCode);

        return $response;
    }

    private function creationActOfTaking(Request $request): array
    {
        $dataToCreate = $request->request->all();



        if (false === array_key_exists('act', $dataToCreate)) {
            throw new RuntimeException("Отсутствуют данные о акте");
        }
        $result = [
            'act' => [],

        ];

        if ('actOfTaking' === $dataToCreate['act']) {
            $result['act'] = $this->validateActOfTaking($dataToCreate);
            if (0 === count($result['act'])) {
                $this->createActOfTaking($dataToCreate);
            }
        } else {
            throw new RuntimeException("Неизвесный тип акта");
        }

        return $result;
    }

    /**
     * Валидация актов взятия
     *
     * @param array $dataToCreate
     *
     * @return array
     */
    private function validateActOfTaking(array $dataToCreate): array
    {
        $errs = [];
        $errCount = $this->validateCount($dataToCreate);
        if (count($errCount) > 0) {
            $errs = array_merge($errs, $errCount);
        }
        $this->validateBooks($dataToCreate);
        $this->validateParticipants($dataToCreate);
        return $errs;
    }

    /**
     * Валидация количества книг
     *
     * @param array $dataToCreate
     *
     * @return array
     */
    private function validateCount(array $dataToCreate): array
    {
        $errs = [];

        if (false === (array_key_exists('count', $dataToCreate))) {
            throw new RuntimeException('Нет данных количестве книг');
        }

        if (false === is_string($dataToCreate['count'])) {
            throw new RuntimeException('Данные о количестве книг должны быть строкой');
        }


        $trimCount = trim($dataToCreate['count']);


        $errCount = [];
        if ($trimCount === '') {
            $errCount[] = "Количество книг не должно быть пустой строкой";
        } elseif (1 === preg_match('/^-[0-9]+$/', $trimCount)) {
            $errCount[] = "Количество книг должно быть положительным";
        } elseif (1 === preg_match('/^[0]+$/', $trimCount)) {
            $errCount[] = "Количество книг не должно быть равно нулю";
        } elseif (1 !== preg_match('/^[0-9]+$/', $trimCount)) {
            $errCount[] = "Количество книг должно быть числом";
        }
        //TODO тебе еще искать где делать кэширование (bookservice)(pointservic... cringe)
        if (0 !== count($errCount)) {
            $errs['count'] = $errCount;
        }

        return $errs;
    }

    /**
     * Валидация данных о книгах
     *
     * @param array $dataToCreate
     */
    private function validateBooks(array $dataToCreate): void
    {
        if (false === (array_key_exists('book_id', $dataToCreate))) {
            throw new RuntimeException('Нет данных об книге');
        }

        if (false === is_string($dataToCreate['book_id'])) {
            throw new RuntimeException('Данные об книге должны быть строкой');
        }

        if (!('null' === $dataToCreate['book_id'] || 1 === preg_match('/^\d+$/', $dataToCreate['book_id']))) {
            throw new RuntimeException('Данные об книге имеют некорректный формат');
        }
    }

    /**
     * Валидация данных о пользователях
     *
     * @param array $dataToCreate
     */
    private function validateParticipants(array $dataToCreate): void
    {
        if (false === (array_key_exists('participant_id', $dataToCreate))) {
            throw new RuntimeException('Нет данных о пользователе');
        }

        if (false === is_string($dataToCreate['participant_id'])) {
            throw new RuntimeException('Данные о пользователе должны быть строкой');
        }

        if (!('null' === $dataToCreate['participant_id'] || 1 === preg_match(
                '/^\d+$/',
                $dataToCreate['participant_id']
            ))
        ) {
            throw new RuntimeException('Данные о пользователе имеют некорректный формат');
        }
    }

    private function createActOfTaking(array $dataToCreate): void
    {
        try {
            $this->em->beginTransaction();
            $this->arrivalNewActOfTakingService->registerActOfTaking(
                new NewActOfTakingDto(
                    $dataToCreate['book_id'],
                    $dataToCreate['count'],
                    $dataToCreate['participant_id']
                )
            );
            $this->em->flush();
            $this->em->commit();
        } catch (Throwable $e) {
            $this->em->rollBack();
            throw new RuntimeException(
                'Ошибка при создании акта взятия: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
