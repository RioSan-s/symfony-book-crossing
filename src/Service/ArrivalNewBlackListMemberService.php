<?php

namespace NonEfTech\BookCrossing\Service;

use NonEfTech\BookCrossing\Entity\BlackList;

use NonEfTech\BookCrossing\Entity\BlackListInterface;
use NonEfTech\BookCrossing\Entity\BlackListStatus\Status;
use NonEfTech\BookCrossing\Entity\BlackListStatus\StatusFactoryInterface;
use NonEfTech\BookCrossing\Entity\Participant;
use NonEfTech\BookCrossing\Entity\ParticipantRepositoryInterface;
use NonEfTech\BookCrossing\Exception\RuntimeException;
use NonEfTech\BookCrossing\Factory\StatusFactory;
use NonEfTech\BookCrossing\Repository\BlackListDoctrineRepository;
use NonEfTech\BookCrossing\Repository\ParticipantDoctrineRepository;
use NonEfTech\BookCrossing\Service\ArrivalNewBlackListMemberService\NewBlackListMemberDto;
use NonEfTech\BookCrossing\Service\ArrivalNewBlackListMemberService\ResultRegisterBlackListMemberDto;

class ArrivalNewBlackListMemberService
{
    /**
     * Фабрика по созданию статуса
     * @var StatusFactoryInterface
     */
    private StatusFactoryInterface $statusFactory;

    /**
     * репозиторий для работы с blacklist
     * @var BlackListDoctrineRepository
     */
    private BlackListInterface $blackListDoctrineRepository;

    /**
     * репозиторий для работы с участниками обмена
     * @var ParticipantDoctrineRepository
     */
    private ParticipantRepositoryInterface $participantDoctrineRepository;

    /**
     * @param BlackListDoctrineRepository $blackListDoctrineRepository
     * @param ParticipantDoctrineRepository $participantDoctrineRepository
     * @param StatusFactoryInterface $statusFactory
     */
    public function __construct(
        BlackListInterface $blackListDoctrineRepository,
        ParticipantRepositoryInterface $participantDoctrineRepository,
        StatusFactoryInterface $statusFactory
    ) {
        $this->blackListDoctrineRepository = $blackListDoctrineRepository;
        $this->participantDoctrineRepository = $participantDoctrineRepository;
        $this->statusFactory = $statusFactory;
    }

    public function registerNewBlackListMember(NewBlackListMemberDto $blackListMemberDto
    ): ResultRegisterBlackListMemberDto {
        $participantId = $blackListMemberDto->getParticipant();
        $participantCollection = $this->participantDoctrineRepository->findBy(['id' => $participantId]);

        if (1 !== count($participantCollection)) {
            throw new RuntimeException(
                "Нельзя создать нового члена BlackList с id =$participantId. Участник обмена с таким id не найден"
            );
        }
        $participant = current($participantCollection);
        $status =  $this->validateExistsStatus($blackListMemberDto->getStatus());
        $this->participantInStatusExist($participant, $blackListMemberDto);

        $entity = new BlackList(
            $this->blackListDoctrineRepository->nextId(),
            $participant,
            $blackListMemberDto->getDescription(),
            $status,
            $blackListMemberDto->getDate()

        );

        $this->blackListDoctrineRepository->add($entity);
        return new ResultRegisterBlackListMemberDto(
            $entity->getDescription(),
            $entity->getStatus()->getName(),
            $entity->getParticipant()->getFio(),
            $entity->getDate()->format('Y-m-d H:i:s')
        );
    }

    private function participantInStatusExist(Participant $participant, NewBlackListMemberDto $blackListMemberDto): void
    {
        /** @var BlackList $foundParticipant */
        $foundParticipant = $this->blackListDoctrineRepository->findOneBy(
            ['participant' => $participant->getId()],
            ["date" => "DESC"]
        );

        if (null !== $foundParticipant) {
            if ($foundParticipant->getStatus()->getName() === $blackListMemberDto->getStatus()) {
                throw new RuntimeException(
                    "Пользователь с id {$foundParticipant->getParticipant()->getId()} в статусе: {$blackListMemberDto->getStatus()}"
                );
            }
        }
    }

    private function validateExistsStatus(string $status):Status
    {
       $foundStatus =  $this->statusFactory->findOneBy($status);
       if(null === $foundStatus)
       {
           throw new RuntimeException("Некорректный статус: $status");
       }
       return $foundStatus;
    }

}