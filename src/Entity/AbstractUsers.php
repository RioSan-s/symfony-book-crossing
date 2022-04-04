<?php

namespace NonEfTech\BookCrossing\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Абстрактный класс пользователей
 * @ORM\Entity()
 * @ORM\Table( name="users",
 *     indexes={
 *   @ORM\Index(name="users_date_of_birth_idx", columns={"date_of_birth"}),
 *   @ORM\Index(name="users_type_idx", columns={"type"}),
 *   @ORM\Index(name="users_fio_idx", columns={"fio"}),
 *     },
 *     uniqueConstraints=
 *     {
 *  @ORM\UniqueConstraint (name ="users_phone_number_unq",columns={"phone_number"})
 *     }
 *  )
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type",type="string",length=30)
 * @ORM\DiscriminatorMap({
 *     "admin" = \NonEfTech\BookCrossing\Repository\AdministratorRepository\AdministratorDataProvider::class,
 *     "participant" =\NonEfTech\BookCrossing\Entity\Participant::class
 *     })
 */
abstract class AbstractUsers
{
    /**
     * id пользователя
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable = false)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="users_id_seq")
     * @var int
     */
    private int $id;

    /**
     * ФИО пользователя
     * @ORM\Column(name="fio",type="string",nullable = false,length=250)
     * @var string
     */
    private string $fio;

    /**
     * Номер телефона пользователя
     * @ORM\Column(name="phone_number",type="string",nullable = false,length=35)
     * @var string
     */
    private string $phoneNumber;

    /**
     * Дата рождения пользователя
     *@ORM\Column(name="date_of_birth",type="date_immutable",nullable = false)
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $dateOfBirth;

    /**
     * @param int    $id
     * @param string $fio
     * @param string $phoneNumber
     * @param DateTimeImmutable $dateOfBirth
     */
    public function __construct(int $id, string $fio, string $phoneNumber, DateTimeImmutable $dateOfBirth)
    {
        $this->id = $id;
        $this->fio = $fio;
        $this->phoneNumber = $phoneNumber;
        $this->dateOfBirth = $dateOfBirth;
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
    public function getFio(): string
    {
        return $this->fio;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDateOfBirth(): DateTimeImmutable
    {
        return $this->dateOfBirth;
    }
}
