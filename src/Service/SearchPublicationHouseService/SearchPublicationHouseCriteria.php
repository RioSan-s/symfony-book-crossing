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
     * Владелец дома публикации
     *
     * @var string|null
     */
    private ?string $ownerOfPublicationHouse=null;

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
     * @return SearchPublicationHouseCriteria
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
     *
     * @return SearchPublicationHouseCriteria
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
     *
     * @return SearchPublicationHouseCriteria
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
     *
     * @return SearchPublicationHouseCriteria
     */
    public function setOwnerOfPublicationHouse(?string $ownerOfPublicationHouse): SearchPublicationHouseCriteria
    {
        $this->ownerOfPublicationHouse = $ownerOfPublicationHouse;
        return $this;
    }


}