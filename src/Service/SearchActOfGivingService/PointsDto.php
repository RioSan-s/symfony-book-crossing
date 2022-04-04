<?php

namespace NonEfTech\BookCrossing\Service\SearchActOfGivingService;

final class PointsDto
{
    /**
     * id пункта обмена
     *
     * @var int
     */
    private int $id;

    /**
     * Номер телефона пункта обмена
     *
     * @var string
     */
    private string $phoneNumber;

    /**
     * Адрес пункта обмена
     *
     * @var string
     */
    private string $address;

    /**
     * Время начала работы пункта обмена
     *
     * @var string
     */
    private string $startTime;

    /**
     * Время окончания работы пункта обмена
     *
     * @var string
     */
    private string $endTime;

    /**
     * @param int    $id
     * @param string $phoneNumber
     * @param string $address
     * @param string $startTime
     * @param string $endTime
     */
    public function __construct(int $id, string $phoneNumber, string $address, string $startTime, string $endTime)
    {
        $this->id = $id;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    /**
     * Возвращает id пункта обмена
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Возвращает номер телефона пункта обмена
     *
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * Возвращает адрес пункта обмена
     *
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Возвращает время начала работы пункта обмена
     *
     * @return string
     */
    public function getStartTime(): string
    {
        return $this->startTime;
    }

    /**
     * Возвращает время окончания работы пункта обмена
     *
     * @return string
     */
    public function getEndTime(): string
    {
        return $this->endTime;
    }
}
