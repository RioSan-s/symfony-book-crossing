<?php

namespace NonEfTech\BookCrossing\Service\SearchActOfGivingService;

class SearchActOfGivingCriteria
{
    /**
     * id акта обмена
     *
     * @var string|null
     */
    private ?string $id;

    /**
     * id книги
     *
     * @var string|null
     */
    private ?string $bookId = null;

    /**
     * Название книги
     *
     * @var string|null
     */
    private ?string $title = null;

    /**
     * Имя и фамилия автора книги
     *
     * @var string|null
     */
    private ?string $author = null;

    /**
     * Издательство книги
     *
     * @var string|null
     */
    private ?string $publishingHouse = null;

    /**
     * Год публикации книги
     *
     * @var string|null
     */
    private ?string $yearOfPublication = null;

    /**
     * id пункта обмена
     *
     * @var string|null
     */
    private ?string $pointId = null;

    /**
     * Номер телефона пункта обмена
     *
     * @var string|null
     */
    private ?string $pointPhoneNumber = null;

    /**
     * Страна пункта обмена
     *
     * @var string|null
     */
    private ?string $pointCountry = null;


    /**
     * Город пункта обмена
     *
     * @var string|null
     */
    private ?string $pointCity = null;

    /**
     * Страна пункта обмена
     *
     * @var string|null
     */
    private ?string $pointStreet = null;

    /**
     * Номер дома пункта обмена
     *
     * @var string|null
     */
    private ?string $pointHome = null;

    /**
     * Квартира пункта обмена
     *
     * @var int|null
     */
    private ?int $pointFlat = null;

    /**
     * Время начала работы пункта обмена
     *
     * @var string|null
     */
    private ?string $pointStartTime = null;

    /**
     * Время окончания работы пункта обмена
     *
     * @var string|null
     */
    private ?string $pointEndTime = null;

    /**
     * Количество книг, участвующих в обмене
     *
     * @var int|null
     */
    private ?int $count = null;

    /**
     * id участника обмена
     *
     * @var string|null
     */
    private ?string $participantId = null;

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
     * @return SearchActOfGivingCriteria
     */
    public function setId(?int $id): SearchActOfGivingCriteria
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBookId(): ?int
    {
        return $this->bookId;
    }

    /**
     * @param int|null $bookId
     *
     * @return SearchActOfGivingCriteria
     */
    public function setBookId(?int $bookId): SearchActOfGivingCriteria
    {
        $this->bookId = $bookId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     *
     * @return SearchActOfGivingCriteria
     */
    public function setTitle(?string $title): SearchActOfGivingCriteria
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     *
     * @return SearchActOfGivingCriteria
     */
    public function setAuthor(?string $author): SearchActOfGivingCriteria
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPublishingHouse(): ?string
    {
        return $this->publishingHouse;
    }

    /**
     * @param string|null $publishingHouse
     *
     * @return SearchActOfGivingCriteria
     */
    public function setPublishingHouse(?string $publishingHouse): SearchActOfGivingCriteria
    {
        $this->publishingHouse = $publishingHouse;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getYearOfPublication(): ?string
    {
        return $this->yearOfPublication;
    }

    /**
     * @param string|null $yearOfPublication
     *
     * @return SearchActOfGivingCriteria
     */
    public function setYearOfPublication(?string $yearOfPublication): SearchActOfGivingCriteria
    {
        $this->yearOfPublication = $yearOfPublication;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPointId(): ?int
    {
        return $this->pointId;
    }

    /**
     * @param int|null $pointId
     *
     * @return SearchActOfGivingCriteria
     */
    public function setPointId(?int $pointId): SearchActOfGivingCriteria
    {
        $this->pointId = $pointId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPointPhoneNumber(): ?string
    {
        return $this->pointPhoneNumber;
    }

    /**
     * @param string|null $pointPhoneNumber
     *
     * @return SearchActOfGivingCriteria
     */
    public function setPointPhoneNumber(?string $pointPhoneNumber): SearchActOfGivingCriteria
    {
        $this->pointPhoneNumber = $pointPhoneNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPointCountry(): ?string
    {
        return $this->pointCountry;
    }

    /**
     * @param string|null $pointCountry
     * @return SearchActOfGivingCriteria
     */
    public function setPointCountry(?string $pointCountry): SearchActOfGivingCriteria
    {
        $this->pointCountry = $pointCountry;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPointCity(): ?string
    {
        return $this->pointCity;
    }

    /**
     * @param string|null $pointCity
     * @return SearchActOfGivingCriteria
     */
    public function setPointCity(?string $pointCity): SearchActOfGivingCriteria
    {
        $this->pointCity = $pointCity;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPointStreet(): ?string
    {
        return $this->pointStreet;
    }

    /**
     * @param string|null $pointStreet
     * @return SearchActOfGivingCriteria
     */
    public function setPointStreet(?string $pointStreet): SearchActOfGivingCriteria
    {
        $this->pointStreet = $pointStreet;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPointHome(): ?string
    {
        return $this->pointHome;
    }

    /**
     * @param string|null $pointHome
     * @return SearchActOfGivingCriteria
     */
    public function setPointHome(?string $pointHome): SearchActOfGivingCriteria
    {
        $this->pointHome = $pointHome;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPointFlat(): ?int
    {
        return $this->pointFlat;
    }

    /**
     * @param int|null $pointFlat
     * @return SearchActOfGivingCriteria
     */
    public function setPointFlat(?int $pointFlat): SearchActOfGivingCriteria
    {
        $this->pointFlat = $pointFlat;
        return $this;
    }



    /**
     * @return string|null
     */
    public function getPointStartTime(): ?string
    {
        return $this->pointStartTime;
    }

    /**
     * @param string|null $pointStartTime
     *
     * @return SearchActOfGivingCriteria
     */
    public function setPointStartTime(?string $pointStartTime): SearchActOfGivingCriteria
    {
        $this->pointStartTime = $pointStartTime;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPointEndTime(): ?string
    {
        return $this->pointEndTime;
    }

    /**
     * @param string|null $pointEndTime
     *
     * @return SearchActOfGivingCriteria
     */
    public function setPointEndTime(?string $pointEndTime): SearchActOfGivingCriteria
    {
        $this->pointEndTime = $pointEndTime;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCount(): ?int
    {
        return $this->count;
    }

    /**
     * @param int|null $count
     *
     * @return SearchActOfGivingCriteria
     */
    public function setCount(?int $count): SearchActOfGivingCriteria
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getParticipantId(): ?int
    {
        return $this->participantId;
    }

    /**
     * @param int|null $participantId
     *
     * @return SearchActOfGivingCriteria
     */
    public function setParticipantId(?int $participantId): SearchActOfGivingCriteria
    {
        $this->participantId = $participantId;
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
     * @return SearchActOfGivingCriteria
     */
    public function setFio(?string $fio): SearchActOfGivingCriteria
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
     * @return SearchActOfGivingCriteria
     */
    public function setPhoneNumber(?string $phoneNumber): SearchActOfGivingCriteria
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
     * @return SearchActOfGivingCriteria
     */
    public function setDateOfBirth(?string $dateOfBirth): SearchActOfGivingCriteria
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
     * @return SearchActOfGivingCriteria
     */
    public function setEmail(?string $email): SearchActOfGivingCriteria
    {
        $this->email = $email;
        return $this;
    }
}
