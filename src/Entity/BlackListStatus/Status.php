<?php

namespace NonEfTech\BookCrossing\Entity\BlackListStatus;

use Doctrine\ORM\Mapping as ORM;
use NonEfTech\BookCrossing\Exception\RuntimeException;

/**
 * @ORM\Entity
 * @ORM\Table(name="status",
 *     uniqueConstraints=
 *     {
 *     @ORM\UniqueConstraint(name="status_name_key",columns={"name"})
 *     })
 */
class Status
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer",nullable=false)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="status_id_seq")
     *
     * @var int
     */
    private int $id = -1;

    /**
     *
     * Имя статуса
     * @ORM\Column(name="name", type="string", nullable=false, length=30)
     * @var string
     */
    private string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->validate($name);
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    private function validate(string $name): void
    {
        if (false === array_key_exists($name, self::ALLOWED_STATUS)) {
            throw new RuntimeException("Некорректный статус пользователя: $name");
        }
    }


    /**
     * Статус забанен
     */
    public const STATUS_BANNED = "banned";

    public const STATUS_UNBANNED = "unBanned";


    private const ALLOWED_STATUS =
        [
            self::STATUS_BANNED => self::STATUS_BANNED,
            self::STATUS_UNBANNED => self::STATUS_UNBANNED,
        ];

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

}