<?php

namespace NonEfTech\BookCrossing\Service\SearchParticipantsService;

class SearchParticipantsCriteria
{
    /**
     * id участника обмена
     *
     * @var int|null
     */
    private ?int $id = null;

    /**
     * ФИО участника обмена
     *
     * @var string|null
     */
    private ?string $fio = null;

    /**
     * Номер телефона участника обмена
     *
     * @var string|null
     */
    private ?string $phoneNumber = null;

    /**
     * Дата рождения участника обмена
     *
     * @var string|null
     */
    private ?string $dateOfBirth = null;

    /**
     * email участника обмена
     *
     * @var string|null
     */
    private ?string $email = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return SearchParticipantsCriteria
     */
    public function setId(?int $id): SearchParticipantsCriteria
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFio(): ?string
    {
        return $this->fio;
    }

    /**
     * @param string|null $fio
     *
     * @return SearchParticipantsCriteria
     */
    public function setFio(?string $fio): SearchParticipantsCriteria
    {
        $this->fio = $fio;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     *
     * @return SearchParticipantsCriteria
     */
    public function setPhoneNumber(?string $phoneNumber): SearchParticipantsCriteria
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateOfBirth(): ?string
    {
        return $this->dateOfBirth;
    }

    /**
     * @param string|null $dateOfBirth
     *
     * @return SearchParticipantsCriteria
     */
    public function setDateOfBirth(?string $dateOfBirth): SearchParticipantsCriteria
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return SearchParticipantsCriteria
     */
    public function setEmail(?string $email): SearchParticipantsCriteria
    {
        $this->email = $email;
        return $this;
    }
}
