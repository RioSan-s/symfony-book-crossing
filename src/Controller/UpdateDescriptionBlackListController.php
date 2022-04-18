<?php

namespace NonEfTech\BookCrossing\Controller;

use Doctrine\ORM\EntityManagerInterface;
use NonEfTech\BookCrossing\Exception\RuntimeException;
use NonEfTech\BookCrossing\Service\ChangeDescriptionBlackListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UpdateDescriptionBlackListController extends AbstractController
{
    /**
     * Сервис для обновления описания
     *
     * @var ChangeDescriptionBlackListService
     */
    private ChangeDescriptionBlackListService $blackListService;

    /**
     * Соединение с бд
     *
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @param ChangeDescriptionBlackListService $blackListService
     * @param EntityManagerInterface            $em
     */
    public function __construct(ChangeDescriptionBlackListService $blackListService, EntityManagerInterface $em)
    {
        $this->blackListService = $blackListService;
        $this->em = $em;
    }

    public function __invoke(Request $request): Response
    {
        try {
            $this->em->beginTransaction();
            $requestData = json_decode($request->getContent(), true, 10, JSON_THROW_ON_ERROR);
            if (false === array_key_exists('id', $requestData)) {
                throw new RuntimeException('Не найден id в информации о записи в blackList');
            }
            if (false === array_key_exists('description', $requestData)) {
                throw new RuntimeException('Не найден description в информации о записи в blackList');
            }


            $httpCode = 200;
            $resultDto =
                $this->blackListService->updateDescription((int)$requestData['id'], $requestData['description']);
            $jsonData = $this->buildJsonData($resultDto);
            $this->em->flush();
            $this->em->commit();
        } catch (Throwable $e) {
            $this->em->rollback();
            $httpCode = 400;
            $jsonData = ['status' => 'fail', 'message' => $e->getMessage()];
        }
        return $this->json($jsonData, $httpCode);
    }

    private function buildJsonData(ChangeDescriptionBlackListService\UpdateDescriptionDto $resultDto): array
    {
        return
            [
                'id'             => $resultDto->getId(),
                'participantId' => $resultDto->getParticipant(),
                'description'    => $resultDto->getDescription(),
                'status'         => $resultDto->getStatus(),
                'date'           => $resultDto->getDate()->format('Y-m-d H:i:s'),
            ];
    }


}