<?php

namespace NonEfTech\BookCrossing\Service\ArrivalNewBlackListMemberService;


use DateTimeImmutable;
use NonEfTech\BookCrossing\Entity\BlackListStatus\Status;

class NewBlackListMemberDto
{


    /**
     * Описание
     * @var string
     */
    private string $description;

    /**
     * Статус участника обмена
     * @var string
     */
    private string $status;

    /**
     * @return Status
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Участник обмена
     * @var int
     */
    private int $participant;

    private DateTimeImmutable $date;


    /**
     * @param string $description
     * @param int $participant
     * @param DateTimeImmutable $date
     * @param Status $status
     */
    public function __construct(string $description, int $participant, DateTimeImmutable $date, string $status)
    {
        $this->description = $description;
        $this->participant = $participant;
        $this->date = $date;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }


    /**
     * @return int
     */
    public function getParticipant(): int
    {
        return $this->participant;
    }


}