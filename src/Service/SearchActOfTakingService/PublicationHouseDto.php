<?php

namespace NonEfTech\BookCrossing\Service\SearchActOfTakingService;

use \DateTimeImmutable;

class PublicationHouseDto
{
    /**
     * Идентификатор дома публикации
     * @var int
     */
    private int $id;

    /**
     * Названия дома публикации
     * @var string
     */
    private string $nameOfPublicationHouse;

    /**
     * Год создания публикации
     *
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $yearOfCreation;

    /**
     * Владелец дома публикации
     * @var string
     */
    private string $ownerOfPublicationHouse;

    /**
     * @param int                                  $id
     * @param string                               $nameOfPublicationHouse
     * @param DateTimeImmutable $yearOfCreation
     * @param string                               $ownerOfPublicationHouse
     */
    public function __construct(int $id,
        string $nameOfPublicationHouse,
        DateTimeImmutable $yearOfCreation,
        string $ownerOfPublicationHouse
    )
    {
        $this->id = $id;
        $this->nameOfPublicationHouse = $nameOfPublicationHouse;
        $this->yearOfCreation = $yearOfCreation;
        $this->ownerOfPublicationHouse = $ownerOfPublicationHouse;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNameOfPublicationHouse(): string
    {
        return $this->nameOfPublicationHouse;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getYearOfCreation(): DateTimeImmutable
    {
        return $this->yearOfCreation;
    }

    /**
     * @return string
     */
    public function getOwnerOfPublicationHouse(): string
    {
        return $this->ownerOfPublicationHouse;
    }

}