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
