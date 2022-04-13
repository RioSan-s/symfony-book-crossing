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
     * Страна пункта обмена
     *
     * @var string
     */
    private string $country;

    /**
     * Город пункта обмена
     *
     * @var string
     */
    private string $city;

    /**
     * Улица пункта обмена
     *
     * @var string
     */
    private string $street;

    /**
     * Номер дома пункта обмена
     *
     * @var string
     */
    private string $home;

    /**
     * Номер квартиры пункта обмена
     *
     * @var int
     */
    private int $flat;


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
     * @param int $id
     * @param string $phoneNumber
     * @param string $startTime
     * @param string $endTime
     * @param string $country
     * @param string $city
     * @param string $street
     * @param string $home
     * @param int $flat
     */
    public function __construct(
        int $id,
        string $phoneNumber,
        string $country,
        string $city,
        string $street,
        string $home,
        int $flat,
        string $startTime,
        string $endTime

    ) {
        $this->id = $id;
        $this->phoneNumber = $phoneNumber;

        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->home = $home;
        $this->flat = $flat;
    }/**
 * @return string
 */
public function getCountry(): string
{
    return $this->country;
}/**
 * @return string
 */
public function getCity(): string
{
    return $this->city;
}/**
 * @return string
 */
public function getStreet(): string
{
    return $this->street;
}/**
 * @return string
 */
public function getHome(): string
{
    return $this->home;
}/**
 * @return int
 */
public function getFlat(): int
{
    return $this->flat;
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
