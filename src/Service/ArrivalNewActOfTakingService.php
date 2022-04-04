<?php

namespace NonEfTech\BookCrossing\Service;

use NonEfTech\BookCrossing\Entity\ActOfTaking;
use NonEfTech\BookCrossing\Entity\ActOfTakingRepositoryInterface;
use NonEfTech\BookCrossing\Entity\BookRepositoryInterface;
use NonEfTech\BookCrossing\Entity\ParticipantRepositoryInterface;
use NonEfTech\BookCrossing\Exception\RuntimeException;
use NonEfTech\BookCrossing\Service\ArrivalNewActOfTakingService\NewActOfTakingDto;
use NonEfTech\BookCrossing\Service\ArrivalNewActOfTakingService\ResultRegisteringActOfTakingDto;

final class ArrivalNewActOfTakingService
{
    /**
     * Репозиторий для работы с актами взятия
     *
     * @var ActOfTakingRepositoryInterface
     */
    private ActOfTakingRepositoryInterface $actOfTakingRepository;

    /**
     * Репозиторий для работы с книгами
     *
     * @var BookRepositoryInterface
     */
    private BookRepositoryInterface $bookRepository;

    /**
     * Репозиторий для работы с пользователями
     *
     * @var ParticipantRepositoryInterface
     */
    private ParticipantRepositoryInterface $participantRepository;

    /**
     * @param ActOfTakingRepositoryInterface $actOfTakingRepository
     * @param BookRepositoryInterface        $bookRepository
     * @param ParticipantRepositoryInterface $participantRepository
     */
    public function __construct(
        ActOfTakingRepositoryInterface $actOfTakingRepository,
        BookRepositoryInterface $bookRepository,
        ParticipantRepositoryInterface $participantRepository
    )
    {
        $this->actOfTakingRepository = $actOfTakingRepository;
        $this->bookRepository = $bookRepository;
        $this->participantRepository = $participantRepository;
    }



    public function registerActOfTaking(NewActOfTakingDto $actOfTakingDto): ResultRegisteringActOfTakingDto
    {
        $bookId = $actOfTakingDto->getBookId();


        $booksCollections = $this->bookRepository->findBy(['id' => $bookId]);

        if (1 !== count($booksCollections)) {
            throw new RuntimeException(
                "Нельзя зарегестрировать акт взятия с book_id='$bookId'. Книга с данным id не найден."
            );
        }
        $book = current($booksCollections);

        $participantId = $actOfTakingDto->getParticipantId();
        $participantCollections = $this->participantRepository->findBy(['id' => $participantId]);

        if (1 !== count($participantCollections)) {
            throw new RuntimeException(
                "Нельзя зарегестрировать акт взятия с participant_id='$participantId'. 
                Пользователь с данным id не найден."
            );
        }
        $participant = current($participantCollections);

        $entity = new ActOfTaking(
            $this->actOfTakingRepository->nextId(),
            $book,
            $actOfTakingDto->getCount(),
            $participant,
        );
        $this->actOfTakingRepository->add($entity);
        return new ResultRegisteringActOfTakingDto($entity->getId());
    }
}
