<?php

namespace NonEfTech\BookCrossing\Service\ChangeDescriptionBlackListService;

use DateTimeImmutable;

class UpdateDescriptionDto
{

    /**
     * id записи
     * @var int
     */
    private int $id;

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
     * Участник обмена
     * @var int
     */
    private int $participant;

    /**
     * Дата добавления в блек лист
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $date;

    /**
     * @param int               $id
     * @param string            $description
     * @param string            $status
     * @param int               $participant
     * @param DateTimeImmutable $date
     */
    public function __construct(int $id, string $description, string $status, int $participant, DateTimeImmutable $date)
    {
        $this->id = $id;
        $this->description = $description;
        $this->status = $status;
        $this->participant = $participant;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getParticipant(): int
    {
        return $this->participant;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }



}