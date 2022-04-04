<?php

namespace NonEfTech\BookCrossing\Service\SearchParticipantsService;

use DateTimeImmutable;

final class ParticipantsDto
{
    /**
     * id участника обмена
     *
     * @var int
     */
    private int $id;

    /**
     * ФИО участника обмена
     *
     * @var string
     */
    private string $fio;

    /**
     * Номер телефона участника обмена
     *
     * @var string
     */
    private string $phoneNumber;

    /**
     * Дата рождения участника обмена
     *
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $dateOfBirth;

    /**
     * email участника обмена
     *
     * @var string
     */
    private string $email;

    /**
     * @param int    $id          - id участника обмена
     * @param string $fio         - ФИО участника обмена
     * @param string $phoneNumber - номер телефона участника обмена
     * @param DateTimeImmutable $dateOfBirth - дата рождения участника обмена
     * @param string $email       - email участника обмена
     */
    public function __construct(int $id, string $fio, string $phoneNumber, DateTimeImmutable $dateOfBirth, string $email)
    {
        $this->id = $id;
        $this->fio = $fio;
        $this->phoneNumber = $phoneNumber;
        $this->dateOfBirth = $dateOfBirth;
        $this->email = $email;
    }

    /**
     * Возвращает id участника обмена
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Возвращает ФИО участника обмена
     *
     * @return string
     */
    public function getFio(): string
    {
        return $this->fio;
    }

    /**
     * Возвращает номер телефона участника обмена
     *
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * Возвращает дату рождения участника обмена
     *
     * @return string
     */
    public function getDateOfBirth(): DateTimeImmutable
    {
        return $this->dateOfBirth;
    }

    /**
     * Возвращает email участника обмена
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
