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
     * Страна пункта обмена
     *
     * @var string|null
     */
    private ?string $country = null;


    /**
     * Город пункта обмена
     *
     * @var string|null
     */
    private ?string $city = null;

    /**
     * Страна пункта обмена
     *
     * @var string|null
     */
    private ?string $street = null;

    /**
     * Номер дома пункта обмена
     *
     * @var string|null
     */
    private ?string $home = null;

    /**
     * Квартира пункта обмена
     *
     * @var int|null
     */
    private ?int $flat = null;

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
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): SearchPointsCriteria
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): SearchPointsCriteria
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     */
    public function setStreet(?string $street): SearchPointsCriteria
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHome(): ?string
    {
        return $this->home;
    }

    /**
     * @param string|null $home
     */
    public function setHome(?string $home): SearchPointsCriteria
    {
        $this->home = $home;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getFlat(): ?int
    {
        return $this->flat;
    }

    /**
     * @param int|null $flat
     */
    public function setFlat(?int $flat): SearchPointsCriteria
    {
        $this->flat = $flat;
        return $this;
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
