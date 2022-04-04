<?php

namespace NonEfTech\BookCrossing\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use NonEfTech\BookCrossing\Exception\DomainException;

/**
 * Валюта
 * @ORM\Entity()
 * @ORM\Table(name="currency",
 *     uniqueConstraints=
 *     {
 *     @ORM\UniqueConstraint(name="currency_code_unq",columns={"code"}),
 *     @ORM\UniqueConstraint(name="currency_name_unq",columns={"name"}),
 *     })
 */
class Currency
{
    /**
     * id currency
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable = false)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="currency_id_seq")
     *
     * @var int|null
     */
    private ?int $id = null;

    /**
     * Код валюты
     * @ORM\Column(name="code", type="string",nullable=false,length=3)
     * @var string
     */
    private string $code;

    /**
     * Имя валюты
     * @ORM\Column(name="name", type="string",nullable=false,length=3)
     * @var string
     */
    private string $name;

    /**
     * Описание валюты
     * @ORM\Column(name="description", type="string",nullable=false,length=255)
     * @var string
     */
    private string $description;

    /**
     * @param string $code - Код валюты
     * @param string $name - Имя валюты
     * @param string $description - описание валюты
     */
    public function __construct(string $code, string $name, string $description)
    {
        $this->validate($code, $name, $description);
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * Возвращает описание валюты
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Валидация данных
     *
     * @param string $code
     * @param string $name
     * @param string $description
     *
     * @return void
     */
    private function validate(string $code, string $name, string $description): void
    {
        if (1 !== preg_match('/^\d{3}$/', $code)) {
            throw new DomainException('Некорректный формат кода валюты');
        }
        if (1 !== preg_match('/^[A-Z]{3}$/', $name)) {
            throw new DomainException('Некорректное имя валюты');
        }
        if (strlen($description) > 255) {
            throw new DomainException('Длина описания валюты не может превышать 255 символов');
        }
        if ('' === trim($description)) {
            throw new DomainException('Описание валюты не может быть пустой строкой');
        }
    }

    /**
     * Код валюты (RUB)
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Имя валюты (Рубль)
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}
