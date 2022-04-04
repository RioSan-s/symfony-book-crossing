<?php

namespace NonEfTech\BookCrossing\Service\ArrivalNewActOfTakingService;

class NewActOfTakingDto
{
    /**
     * Книга, участвующая в акте обмена
     *
     * @var int
     */
    private int $book_id;

    /**
     * Количество книг, участвующих в обмене
     *
     * @var int
     */
    private int $count;

    /**
     * Участник обмена
     *
     * @var int
     */
    private int $participant_id;

    /**
     * @param int $book_id
     * @param int $count
     * @param int $participant_id
     */
    public function __construct(int $book_id, int $count, int $participant_id)
    {
        $this->book_id = $book_id;
        $this->count = $count;
        $this->participant_id = $participant_id;
    }

    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->book_id;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function getParticipantId(): int
    {
        return $this->participant_id;
    }
}
