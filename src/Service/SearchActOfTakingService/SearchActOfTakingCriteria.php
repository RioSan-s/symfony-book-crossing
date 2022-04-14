<?php

namespace NonEfTech\BookCrossing\Service\SearchActOfTakingService;

class SearchActOfTakingCriteria
{
    /**
     * id акта обмена
     *
     * @var int|null
     */
    private ?int $id = null;

    /**
     * id книги
     *
     * @var int|null
     */
    private ?int $bookId = null;

    /**
     * Название книги
     *
     * @var string|null
     */
    private ?string $title = null;

    /**
     * Названия дома публикации
     *
     * @var string|null
     */
    private ?string $phNameOfPublicationHouse =null;

    /**
     * Имя и фамилия автора книги
     *
     * @var string|null
     */
    private ?string $author = null;



    /**
     * Год публикации книги
     *
     * @var string|null
     */
    private ?string $yearOfPublication = null;

    /**
     * id пункта обмена
     *
     * @var int|null
     */
    private ?int $pointId = null;

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
     * @return string|null
     */
    public function getPointCountry(): ?string
    {
        return $this->pointCountry;
    }

    /**
     * @param string|null $pointCountry
     * @return SearchActOfTakingCriteria
     */
    public function setPointCountry(?string $pointCountry): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setPointCity(?string $pointCity): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setPointStreet(?string $pointStreet): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setPointHome(?string $pointHome): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setPointFlat(?int $pointFlat): SearchActOfTakingCriteria
    {
        $this->pointFlat = $pointFlat;
        return $this;
    }

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
     * @var int|null
     */
    private ?int $participantId = null;

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
     * @return SearchActOfTakingCriteria
     */
    public function setId(?int $id): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setBookId(?int $bookId): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setTitle(?string $title): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setAuthor(?string $author): SearchActOfTakingCriteria
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhNameOfPublicationHouse(): ?string
    {
        return $this->phNameOfPublicationHouse;
    }

    /**
     * @param string|null $phNameOfPublicationHouse
     * @return SearchActOfTakingCriteria
     */
    public function setPhNameOfPublicationHouse(?string $phNameOfPublicationHouse): SearchActOfTakingCriteria
    {
        $this->phNameOfPublicationHouse = $phNameOfPublicationHouse;
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
     * @return SearchActOfTakingCriteria
     */
    public function setYearOfPublication(?string $yearOfPublication): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setPointId(?int $pointId): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setPointPhoneNumber(?string $pointPhoneNumber): SearchActOfTakingCriteria
    {
        $this->pointPhoneNumber = $pointPhoneNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPointAddress(): ?string
    {
        return $this->pointAddress;
    }

    /**
     * @param string|null $pointAddress
     *
     * @return SearchActOfTakingCriteria
     */
    public function setPointAddress(?string $pointAddress): SearchActOfTakingCriteria
    {
        $this->pointAddress = $pointAddress;
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
     * @return SearchActOfTakingCriteria
     */
    public function setPointStartTime(?string $pointStartTime): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setPointEndTime(?string $pointEndTime): SearchActOfTakingCriteria
    {
        $this->pointEndTime = $pointEndTime;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCount(): ?int
    {
        return $this->count;
    }

    /**
     * @param int|null $count
     *
     * @return SearchActOfTakingCriteria
     */
    public function setCount(?int $count): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setParticipantId(?int $participantId): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setFio(?string $fio): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setPhoneNumber(?string $phoneNumber): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setDateOfBirth(?string $dateOfBirth): SearchActOfTakingCriteria
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
     * @return SearchActOfTakingCriteria
     */
    public function setEmail(?string $email): SearchActOfTakingCriteria
    {
        $this->email = $email;
        return $this;
    }
}
