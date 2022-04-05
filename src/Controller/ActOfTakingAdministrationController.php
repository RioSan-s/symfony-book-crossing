<?php

namespace NonEfTech\BookCrossing\Controller;

use Doctrine\ORM\EntityManagerInterface;
use NonEfTech\BookCrossing\Exception\RuntimeException;

use NonEfTech\BookCrossing\Form\CreateActOfTakingForm;
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
     * Сервис поиска актов взятия
     *
     * @var SearchActOfTakingService
     */
    private SearchActOfTakingService $actOfTakingService;


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
     * @param SearchActOfTakingService $actOfTakingService
     * @param ArrivalNewActOfTakingService $arrivalNewActOfTakingService
     * @param EntityManagerInterface $em
     */
    public function __construct(

        SearchActOfTakingService $actOfTakingService,
        ArrivalNewActOfTakingService $arrivalNewActOfTakingService,
        EntityManagerInterface $em
    ) {
        $this->actOfTakingService = $actOfTakingService;
        $this->arrivalNewActOfTakingService = $arrivalNewActOfTakingService;
        $this->em = $em;
    }

    public function __invoke(Request $request): Response
    {
        $formActs = $this->createForm(CreateActOfTakingForm::class);

        $formActs->handleRequest($request);
        if ($formActs->isSubmitted() && $formActs->isValid()) {
            $this->createActOfTaking($formActs->getData());
            $formActs = $this->createForm(CreateActOfTakingForm::class);
        }

        $template = 'actOfTaking.administration.twig';
        $context = [
            'form_act_of_taking' => $formActs,
            'actOfTaking' => $this->actOfTakingService->search(new SearchActOfTakingCriteria()),

        ];
        $response = $this->renderForm(
            $template,
            $context
        );
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
