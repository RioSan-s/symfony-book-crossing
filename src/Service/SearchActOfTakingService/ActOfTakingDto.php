<?php

namespace NonEfTech\BookCrossing\Service\SearchActOfTakingService;

final class ActOfTakingDto
{
    /**
     * id акта обмена
     *
     * @var int
     */
    private int $id;

    /**
     * Книга, участвующая в акте обмена
     *
     * @var BooksDto
     */
    private BooksDto $book;

    /**
     * Количество книг, участвующих в обмене
     *
     * @var int
     */
    private int $count;

    /**
     * Участник обмена
     *
     * @var ParticipantsDto
     */
    private ParticipantsDto $participant;

    /**
     * @param int             $id          - id акта обмена
     * @param BooksDto        $book        - книга, участвующая в обмене
     * @param int             $count       - количество книг, участвующих в обмене
     * @param ParticipantsDto $participant - участник обмена
     */
    public function __construct(int $id, BooksDto $book, int $count, ParticipantsDto $participant)
    {
        $this->id = $id;
        $this->book = $book;
        $this->count = $count;
        $this->participant = $participant;
    }

    /**
     * Возвращает id акта обмена
     *
     * @return int
     */
    final public function getId(): int
    {
        return $this->id;
    }

    /**
     * Возвращает книгу, участвующую в акте обмена
     *
     * @return BooksDto
     */
    final public function getBook(): BooksDto
    {
        return $this->book;
    }

    /**
     * Возвращает количество книг, участвующих в акте обмена
     *
     * @return int
     */
    final public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Возвращает участника обмена
     *
     * @return ParticipantsDto
     */
    final public function getParticipant(): ParticipantsDto
    {
        return $this->participant;
    }
}
