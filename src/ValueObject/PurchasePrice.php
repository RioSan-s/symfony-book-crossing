<?php

namespace NonEfTech\BookCrossing\ValueObject;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use NonEfTech\BookCrossing\Entity\Book;

/**
 * @ORM\Entity
 * @ORM\Table(name="purchase_prices")
 * Закупочная цена
 */
final class PurchasePrice
{
    /**
     * id Закупочной цены
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable = false)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="purchase_prices_id_seq")
     *
     * @var int|null
     */
    private ?int $id = null;

    /**
     * Время когда была получена информаия по закупочной цене
     * @ORM\Column(name="date", type="datetime_immutable",nullable=false)
     *
     * @var DateTimeInterface
     */
    private DateTimeInterface $date;


    /**
     * Значение стоимости закупочной цены
     * @ORM\Column(name="price",type="integer",nullable=false)
     *
     * @var int
     */
    private int $price;


    /**
     * Цена
     *
     * @var Money|null
     */
    private ?Money $money = null;

    /**
     * Валюта закупочной цены
     * @ORM\ManyToOne(targetEntity=\NonEfTech\BookCrossing\ValueObject\Currency::class)
     * @ORM\JoinColumn (name="currency_id", referencedColumnName="id")
     *
     * @var Currency
     */
    private Currency $currency;


    /**
     * Ассоциация с текстовым документом
     * @ORM\ManyToOne(targetEntity=\NonEfTech\BookCrossing\Entity\Book::class, inversedBy="purchasePrices")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     *
     * @var Book|null
     */
    private ?Book $book = null;


    /**
     * @param DateTimeInterface $date - Время когда была получена информаия по закупочной цене
     * @param Money $money - Цена
     */
    public function __construct(DateTimeInterface $date, Money $money)
    {
        $this->date = $date;
        $this->money = $money;
        $this->price = $money->getAmount();
        $this->currency = $money->getCurrency();
    }


    /**
     * Возвращает цену
     *
     * @return Money
     */
    public function getMoney(): Money
    {
        if (null === $this->money) {
            $this->money = new Money($this->price, $this->currency);
        }
        return $this->money;
    }

    /**
     * Возвращает время когда была получена информаия по закупочной цене
     *
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }


}
