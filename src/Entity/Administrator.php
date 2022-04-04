<?php

namespace NonEfTech\BookCrossing\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Администратор
 * @ORM\MappedSuperclass()
 *
 */
class Administrator extends AbstractUsers
{

    /**
     * Пункт обмена книги
     * @ORM\ManyToOne(targetEntity=\NonEfTech\BookCrossing\Entity\Point::class)
     * @ORM\JoinColumn(name="point_id",referencedColumnName="id")
     * @var Point
     */
    private Point $point;

    /**
     * Зарплата администратора
     * @ORM\Column(name="salary", type="integer", nullable = false)
     * @var int
     */
    private int $salary;

    /**
     * Логин пользователя в системе
     * @ORM\Column(name="login",type="string",nullable = false,length=25)
     * @var string
     */
    private string $login;

    /**
     * Пароль пользователя в системе
     * @ORM\Column(name="password",type="string",nullable = false,length=200)
     * @var string
     */
    private string $password;

    /**
     * @param int $id
     * @param string $fio
     * @param string $phoneNumber
     * @param DateTimeImmutable $dateOfBirth
     * @param Point $point
     * @param int $salary
     * @param string $login
     * @param string $password
     */
    public function __construct(
        int $id,
        string $fio,
        string $phoneNumber,
        DateTimeImmutable $dateOfBirth,
        Point $point,
        int $salary,
        string $login,
        string $password
    ) {
        parent::__construct($id, $fio, $phoneNumber, $dateOfBirth);
        $this->point = $point;
        $this->salary = $salary;
        $this->login = $login;
        $this->password = $password;
    }


    /**
     * Возвращает логин пользователя в системе
     *
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * Возвращает пароль пользователя в системе
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }


    /**
     * Возвращает пункт обмена администратора
     *
     * @return Point
     */
public function getPoint(): Point
    {
        return $this->point;
    }

    /**
     * Устанавливает пункт обмена администратора
     *
     * @param Point $point
     *
     * @return Administrator
     */
    public function setPoint(Point $point): Administrator
    {
        $this->point = $point;
        return $this;
    }

    /**
     * Возвращает зарплату администратора
     *
     * @return int
     */
  public function getSalary(): int
    {
        return $this->salary;
    }

    /**
     * Устанавливает зарплату администратора
     *
     * @param int $salary
     *
     * @return Administrator
     */
    public function setSalary(int $salary): Administrator
    {
        $this->salary = $salary;
        return $this;
    }
}
