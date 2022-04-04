<?php

namespace NonEfTech\BookCrossing\ValueObject;

/**
 * Просто деньги
 */
class Money
{
    /**
     * Количество
     *
     * @var int
     */
    private int $amount;

    /***
     * Представление денег в формате с плавающей точкой
     *
     * @var float|null
     */
    private ?float $decimal = null;

    /**
     * Валюта
     *
     * @var Currency
     */
    private Currency $currency;

    /**
     * @param int      $amount
     * @param Currency $currency
     */
    public function __construct(int $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * Возвращаем количество
     *
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getDecimal(): float
    {
        if (null === $this->decimal) {
            $this->decimal = $this->amount / 100;
        }
        return $this->decimal;
    }

    /**
     * Возвращаем валюту
     *
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }


}
