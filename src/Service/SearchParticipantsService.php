<?php

namespace NonEfTech\BookCrossing\Service;

use NonEfTech\BookCrossing\Entity\Participant;
use NonEfTech\BookCrossing\Entity\ParticipantRepositoryInterface;
use NonEfTech\BookCrossing\Service\SearchParticipantsService\ParticipantsDto;
use NonEfTech\BookCrossing\Service\SearchParticipantsService\SearchParticipantsCriteria;
use Psr\Log\LoggerInterface;

final class SearchParticipantsService
{
    /**
     * Логер
     *
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * Репозиторий для работы с пользователями
     *
     * @var ParticipantRepositoryInterface
     */
    private ParticipantRepositoryInterface $participantRepository;

    /**
     * @param LoggerInterface                $logger
     * @param ParticipantRepositoryInterface $participantRepository
     */
    public function __construct(
        LoggerInterface $logger,
        ParticipantRepositoryInterface $participantRepository
    )
    {
        $this->logger = $logger;

        $this->participantRepository = $participantRepository;
    }


    public function search(SearchParticipantsCriteria $searchCriteria): array
    {
        $criteria = $this->searchCriteriaToArray($searchCriteria);
        $entitiesCollection = $this->participantRepository->findBy($criteria);
        $dtoCollection = [];
        foreach ($entitiesCollection as $entity) {
            $dtoCollection[] = $this->createDto($entity);
        }
        $this->logger->debug(
            'found participants: ' . count($entitiesCollection)
        );
        return $dtoCollection;
    }

    /**
     * Приобразует критериии поиска в массив
     *
     * @param SearchParticipantsCriteria $searchCriteria
     *
     * @return array
     */
    private function searchCriteriaToArray(SearchParticipantsCriteria $searchCriteria): array
    {
        $criteriaForRepository = [
            'id'          => $searchCriteria->getId(),
            'fio'         => $searchCriteria->getFio(),
            'phone_number' => $searchCriteria->getPhoneNumber(),
            'date_of_birth' => $searchCriteria->getDateOfBirth(),
            'email'       => $searchCriteria->getEmail(),

        ];
        return array_filter($criteriaForRepository, static function ($v): bool {
            return null !== $v;
        });
    }

    /**
     * Создание дто по пунктам обмена
     *
     * @param Participant $participant
     *
     * @return ParticipantsDto
     */
    private function createDto(Participant $participant): ParticipantsDto
    {
        return new ParticipantsDto(
            $participant->getId(),
            $participant->getFio(),
            $participant->getPhoneNumber()->getPhoneNumber(),
            $participant->getDateOfBirth(),
            $participant->getEmail()
        );
    }
}
