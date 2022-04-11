<?php

namespace NonEfTech\BookCrossing\Service\SearchPublicationHouseService;

class SearchPublicationHouseCriteria
{
    /**
     * id пункта обмена
     *
     * @var int|null
     */
    private ?int $id = null;

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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): SearchPublicationHouseCriteria
    {
        $this->id = $id;
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
     */
    public function setNameOfPublicationHouse(?string $nameOfPublicationHouse): SearchPublicationHouseCriteria
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
     */
    public function setYearOfCreation(?string $yearOfCreation): SearchPublicationHouseCriteria
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
     */
    public function setOwnerOfPublicationHouse(?string $ownerOfPublicationHouse): SearchPublicationHouseCriteria
    {
        $this->ownerOfPublicationHouse = $ownerOfPublicationHouse;
        return $this;
    }

    /**
     * Владелец дома публикации
     *
     * @var string|null
     */
    private ?string $ownerOfPublicationHouse=null;
}