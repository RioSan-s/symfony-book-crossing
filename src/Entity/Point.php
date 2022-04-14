<?php

namespace NonEfTech\BookCrossing\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use NonEfTech\BookCrossing\ValueObject\Addresses;

/**
 * Пункт обмена
 * @ORM\Table(name="points",
 * indexes={
 *     @ORM\Index(name="points_end_time_idx", columns={"end_time"}),
 *     @ORM\Index(name="points_start_time_idx", columns={"start_time"}),
 *     },
 *     uniqueConstraints={
 *     @ORM\UniqueConstraint (name ="points_address_unq",columns={"address"}),
 *     @ORM\UniqueConstraint (name ="points_phone_number_unq",columns={"phone_number"})
 *     }
 * )
 * @ORM\Entity(repositoryClass=\NonEfTech\BookCrossing\Repository\PointDoctrineRepository::class)
 */
class Point
{
    /**
     * id пункта обмена
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable = false)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="points_id_seq")
     * @var int
     */
    private int $id;

    /**
     * Номер телефона пункта обмена
     *
     * @ORM\Column(name="phone_number", type="string", nullable = false, length=20)
     * @var string
     */
    private string $phoneNumber;

    /**
     * Адрес пункта обмена
     * @ORM\Embedded(class=\NonEfTech\BookCrossing\ValueObject\Addresses::class, columnPrefix=false)
     *
     * @var Addresses
     */
    private Addresses $address;

    /**
     * Время начала работы пункта обмена
     * @ORM\Column(name="start_time", type="time_immutable", nullable = false)
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $startTime;

    /**
     * Время окончания работы пункта обмена
     * @ORM\Column(name="end_time", type="time_immutable", nullable = false)
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $endTime;

    /**
     * @ORM\OneToMany(targetEntity=\NonEfTech\BookCrossing\Entity\Book::class, mappedBy="point")
     * @var Collection|Point[]
     */
    private Collection $book;

    /**
     * @return Collection|Point[]
     */
    public function getBook()
    {
        return $this->book->toArray();
    }

    /**
     * @param int $id - id пункта обмена
     * @param string $phoneNumber - номер телефона пункта обмена
     * @param Addresses $address - адрес пункта обмена
     * @param DateTimeImmutable $startTime - время начала работы пункта обмена
     * @param DateTimeImmutable $endTime - время окончания работы пункта обмена
     * @param array $book
     */
    public function __construct(
        int $id,
        string $phoneNumber,
        Addresses $address,
        DateTimeImmutable $startTime,
        DateTimeImmutable $endTime,
        array $book = []
    ) {
        $this->id = $id;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->book = new ArrayCollection($book);
    }


    /**
     * Возвращает id пункта обмена
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Возвращает номер телефона пункта обмена
     *
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * Возвращает адрес пункта обмена
     *
     * @return string
     */
    public function getAddress(): Addresses
    {
        return $this->address;
    }

    /**
     * Возвращает время начала работы пункта обмена
     *
     * @return DateTimeImmutable
     */
    public function getStartTime(): DateTimeImmutable
    {
        return $this->startTime;
    }

    /**
     * Возвращает время окончания работы пункта обмена
     *
     * @return DateTimeImmutable
     */
    public function getEndTime(): DateTimeImmutable
    {
        return $this->endTime;
    }
}
