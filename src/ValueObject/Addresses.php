<?php

namespace NonEfTech\BookCrossing\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use NonEfTech\BookCrossing\Exception\RuntimeException;

/**
 * Объект значения адресса
* @ORM\Embeddable()
 */
class Addresses
{

    /**
     * Страна
     * @ORM\Column(name ="country", type="string", nullable=false, length=150)
     * @var string
     */
    private string $country;


    /**
     * Город
     * @ORM\Column(name ="city", type="string", nullable=false, length=150)
     * @var string
     */
    private string $city;

    /**
     * Улица
     * @ORM\Column(name ="street", type="string", nullable=false, length=150)
     * @var string
     */
    private string $street;

    /**
     * Номер дома
     * @ORM\Column(name ="home", type="string", nullable=false, length=10)
     * @var string
     */
    private string $home;

    /**
     * Номер квартиры
     * @ORM\Column(name ="flat", type="integer", nullable=false)
     * @var int
     */
    private int $flat;

    /**
     * @param string $city
     * @param string $street
     * @param string $home
     * @param int    $flat
     * @param string $country
     */
    public function __construct(string $country,string $city, string $street, string $home, int $flat)
    {
        $this->city = $city;
        $this->street = $street;
        $this->home = $home;
        $this->flat = $flat;
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getHome(): string
    {
        return $this->home;
    }

    /**
     * @return int
     */
    public function getFlat(): int
    {
        return $this->flat;
    }


    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    private function validate(string $country,string $city, string $street, string $home, int $flat)
    {
        if(trim($country) ==='' && strlen($country)<150)
        {
            throw new RuntimeException('Название страны не должна быть пустой строкой');
        }
        //валидация

    }

    public function getFullAddress():string
    {
        return "{$this->getCountry()}, г. {$this->getCity()}, {$this->getStreet()} ул., д. {$this->getHome()} кв.{$this->getFlat()}";
    }

}