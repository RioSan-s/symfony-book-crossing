<?php

namespace NonEfTech\BookCrossing\Service\ArrivalNewBlackListMemberService;

class ResultRegisterBlackListMemberDto
{
    /**
     * Описание
     * @var string
     */
    private string $description;

    /**
     * Статус
     * @var string
     */
    private string $status;

    /**
     * Участник обмена
     * @var string
     */
    private string $participant;

    /**
     * Дата изменения
     * @var string
     */
    private string $date;

    /**
     * @param string $description
     * @param string $status
     * @param string $participant
     * @param string $date
     */
    public function __construct(string $description, string $status, string $participant, string $date)
    {
        $this->description = $description;
        $this->status = $status;
        $this->participant = $participant;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getParticipant(): string
    {
        return $this->participant;
    }



}