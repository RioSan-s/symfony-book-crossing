<?php

namespace NonEfTech\BookCrossing\Service\SearchActOfGivingService;

use NonEfTech\BookCrossing\Service\SearchActOfTakingService\PublicationHouseDto;
use NonEfTech\BookCrossing\ValueObject\PurchasePrice;

final class BooksDto
{
    /**
     * id книги
     *
     * @var int
     */
    private int $id;

    /**
     * Название книги
     *
     * @var string
     */
    private string $title;

    /**
     * Имя и фамилия автора книги
     *
     * @var string
     */
    private string $author;

    /**
     * Издательство книги
     *
     * @var string
     */
    private PublicationHouseDto $publishingHouse;

    /**
     * Год публикации книги
     *
     * @var int
     */
    private int $yearOfPublication;

    /**
     * Пункт обмена книги
     *
     * @var PointsDto
     */
    private PointsDto $point;

    /**
     * Даные о закупочных ценах
     *
     * @var PurchasePrice[]
     */
    private array $purchasePrices;

    /**
     * @param int             $id
     * @param string          $title
     * @param string          $author
     * @param PublicationHouseDto          $publishingHouse
     * @param int             $yearOfPublication
     * @param PointsDto       $point
     * @param PurchasePrice[] $purchasePrices
     */
    public function __construct(
        int $id,
        string $title,
        string $author,
        PublicationHouseDto $publishingHouse,
        int $yearOfPublication,
        PointsDto $point,
        array $purchasePrices
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->publishingHouse = $publishingHouse;
        $this->yearOfPublication = $yearOfPublication;
        $this->point = $point;
        $this->purchasePrices = $purchasePrices;
    }

    /**
     * Возвращает айди
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Возвращает заголовок
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Возвращает автора
     *
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Возвращает издание
     *
     * @return string
     */
    public function getPublishingHouse(): PublicationHouseDto
    {
        return $this->publishingHouse;
    }

    /**
     * Возвращает год публикации
     *
     * @return int
     */
    public function getYearOfPublication(): int
    {
        return $this->yearOfPublication;
    }

    /**
     * Возвращает пункт обмена
     *
     * @return PointsDto
     */
    public function getPoint(): PointsDto
    {
        return $this->point;
    }

    /**
     * Возвращает цену
     *
     * @return PurchasePrice[]
     */
    public function getPurchasePrices(): array
    {
        return $this->purchasePrices;
    }
}
