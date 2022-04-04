<?php

namespace NonEfTech\BookCrossing\Service\SearchPointsService;

final class SearchPointsCriteria
{
    /**
     * id пункта обмена
     *
     * @var int|null
     */
    private ?int $id = null;

    /**
     * Номер телефона пункта обмена
     *
     * @var string|null
     */
    private ?string $phoneNumber = null;

    /**
     * Адрес пункта обмена
     *
     * @var string|null
     */
    private ?string $address = null;

    /**
     * Время начала работы пункта обмена
     *
     * @var string|null
     */
    private ?string $startTime = null;

    /**
     * Время окончания работы пункта обмена
     *
     * @var string|null
     */
    private ?string $endTime = null;

    /**
     * Возвращает id пункта обмена
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Устанавливает id пункта обмена
     *
     * @param int|null $id
     *
     * @return SearchPointsCriteria
     */
    public function setId(?int $id): SearchPointsCriteria
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Возвращает номер пункта обмена
     *
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * Устанавливает номер пункта обмена
     *
     * @param string|null $phoneNumber
     *
     * @return SearchPointsCriteria
     */
    public function setPhoneNumber(?string $phoneNumber): SearchPointsCriteria
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * Возвращает адрес пункта обмена
     *
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     *  Устанавливает адрес пункта обмена
     *
     * @param string|null $address
     *
     * @return SearchPointsCriteria
     */
    public function setAddress(?string $address): SearchPointsCriteria
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Вовзращает время начала работы пункта обмена
     *
     * @return string|null
     */
    public function getStartTime(): ?string
    {
        return $this->startTime;
    }

    /**
     * Устанавливает время начала работы пункта обмена
     *
     * @param string|null $startTime
     *
     * @return SearchPointsCriteria
     */
    public function setStartTime(?string $startTime): SearchPointsCriteria
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * Вовзращает время окончания работы пункта обмена
     *
     * @return string|null
     */
    public function getEndTime(): ?string
    {
        return $this->endTime;
    }

    /**
     * Устанавилвает время окончания работы пункта обмена
     *
     * @param string|null $endTime
     *
     * @return SearchPointsCriteria
     */
    public function setEndTime(?string $endTime): SearchPointsCriteria
    {
        $this->endTime = $endTime;
        return $this;
    }
}
