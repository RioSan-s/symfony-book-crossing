<?php

namespace NonEfTech\BookCrossing\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use NonEfTech\BookCrossing\Exception\RuntimeException;

/**
 * Объект значения Номер телефона
 * @ORM\Embeddable()
 */
class PhoneNumber
{
    /**
     * @ORM\Column (name="phone_number", type="string", length=20, nullable=false)
     * Номер телефона
     * @var string
     */
    private string $phoneNumber;

    /**
     * @param string $phoneNumber
     */
    public function __construct(string $phoneNumber)
    {
        $this->validatePhone($phoneNumber);
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Валидация номер телефона
     * @param string $phoneNumber
     *
     * @return void
     */
    private function validatePhone( string $phoneNumber):void
    {
        if( false === preg_match('/^\+\d[ ]\(\d{3}\)[ ]\d{3}-\d{2}-\d{2}$/', $phoneNumber))
        {
            throw new RuntimeException('Номер телефона некорректен');
        }

    }

    /**
     * Возвращает номер телефона
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }


}