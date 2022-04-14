<?php

namespace NonEfTech\BookCrossing\Service\SearchBooksService;

class SearchBooksCriteria
{
    /**
     * id книги
     *
     * @var int|null
     */
    private ?int $id = null;

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
     * id пункта обмена
     *
     * @var int|null
     */
    private ?int $publishingHouseId = null;

    /**
     * Названия дома публикации
     *
     * @var string|null
     */
    private ?string $nameOfPublicationHouse =null;

    /**
     * Год создания публикации
     *
     * @var string|null
     */
    private ?string $yearOfCreation =null;

    /**
     * Владелец дома публикации
     *
     * @var string|null
     */
    private ?string $ownerOfPublicationHouse=null;

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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return SearchBooksCriteria
     */
    public function setId(?int $id): SearchBooksCriteria
    {
        $this->id = $id;
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
     * @return SearchBooksCriteria
     */
    public function setTitle(?string $title): SearchBooksCriteria
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
     * @return SearchBooksCriteria
     */
    public function setAuthor(?string $author): SearchBooksCriteria
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPublishingHouseId(): ?int
    {
        return $this->publishingHouseId;
    }

    /**
     * @param int|null $publishingHouseId
     *
     * @return SearchBooksCriteria
     */
    public function setPublishingHouseId(?int $publishingHouseId): SearchBooksCriteria
    {
        $this->publishingHouseId = $publishingHouseId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNameOfPublicationHouse(): ?string
    {
        return $this->nameOfPublicationHouse;
    }

    /**
     * @param string|null $nameOfPublicationHouse
     *
     * @return SearchBooksCriteria
     */
    public function setNameOfPublicationHouse(?string $nameOfPublicationHouse): SearchBooksCriteria
    {
        $this->nameOfPublicationHouse = $nameOfPublicationHouse;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getYearOfCreation(): ?string
    {
        return $this->yearOfCreation;
    }

    /**
     * @param string|null $yearOfCreation
     *
     * @return SearchBooksCriteria
     */
    public function setYearOfCreation(?string $yearOfCreation): SearchBooksCriteria
    {
        $this->yearOfCreation = $yearOfCreation;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOwnerOfPublicationHouse(): ?string
    {
        return $this->ownerOfPublicationHouse;
    }

    /**
     * @param string|null $ownerOfPublicationHouse
     *
     * @return SearchBooksCriteria
     */
    public function setOwnerOfPublicationHouse(?string $ownerOfPublicationHouse): SearchBooksCriteria
    {
        $this->ownerOfPublicationHouse = $ownerOfPublicationHouse;
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
     * @return SearchBooksCriteria
     */
    public function setYearOfPublication(?string $yearOfPublication): SearchBooksCriteria
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
     * @return SearchBooksCriteria
     */
    public function setPointId(?int $pointId): SearchBooksCriteria
    {
        $this->pointId = $pointId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->pointPhoneNumber;
    }

    /**
     * @param string|null $pointPhoneNumber
     *
     * @return SearchBooksCriteria
     */
    public function setPointPhoneNumber(?string $pointPhoneNumber): SearchBooksCriteria
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
     */
    public function setPointCountry(?string $pointCountry): SearchBooksCriteria
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
     */
    public function setPointCity(?string $pointCity): SearchBooksCriteria
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
     */
    public function setPointStreet(?string $pointStreet): SearchBooksCriteria
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
     */
    public function setPointHome(?string $pointHome): SearchBooksCriteria
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
     */
    public function setPointFlat(?int $pointFlat): SearchBooksCriteria
    {
        $this->pointFlat = $pointFlat;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getStartTime(): ?string
    {
        return $this->pointStartTime;
    }

    /**
     * @param string|null $pointStartTime
     *
     * @return SearchBooksCriteria
     */
    public function setPointStartTime(?string $pointStartTime): SearchBooksCriteria
    {
        $this->pointStartTime = $pointStartTime;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEndTime(): ?string
    {
        return $this->pointEndTime;
    }

    /**
     * @param string|null $pointEndTime
     *
     * @return SearchBooksCriteria
     */
    public function setPointEndTime(?string $pointEndTime): SearchBooksCriteria
    {
        $this->pointEndTime = $pointEndTime;
        return $this;
    }
}
