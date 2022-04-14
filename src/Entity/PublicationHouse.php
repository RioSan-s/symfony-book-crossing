<?php

namespace NonEfTech\BookCrossing\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=\NonEfTech\BookCrossing\Repository\PublicationHouseRepository::class)
 * @ORM\Table (name ="publication_house")
 */
class PublicationHouse
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable = false)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="publication_house_id_seq")
     * Идентификатор дома публикации
     * @var int
     */
    private int $id;

    /**
     * Для связи двунаправленной
     * @ORM\OneToMany(targetEntity=\NonEfTech\BookCrossing\Entity\Book::class, mappedBy="publishingHouse",
     *     cascade={"persist"})
     * @ORM\JoinColumn(name="point_id",referencedColumnName="id")
     *
     * @var Collection
     */
    private Collection $book;

    /**
     * Названия дома публикации
     * @ORM\Column(name="name_of_publication_house", type="string", nullable = false, length=250)
     *
     * @var string
     */
    private string $nameOfPublicationHouse;

    /**
     * Год создания публикации
     * @ORM\Column(name="year_of_creation", type="date_immutable", nullable = false)
     *
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $yearOfCreation;

    /**
     * Владелец дома публикации
     * @ORM\Column(name="owner_of_publication_house", type="string", nullable = false, length=250)
     *
     * @var string
     */
    private string $ownerOfPublicationHouse;

    /**
     * @param int               $id
     * @param string            $nameOfPublicationHouse
     * @param DateTimeImmutable $yearOfCreation
     * @param string            $ownerOfPublicationHouse
     * @param array             $book
     */
    public function __construct(int $id,
        string $nameOfPublicationHouse,
        DateTimeImmutable $yearOfCreation,
        string $ownerOfPublicationHouse,
        array $book
    )
    {
        $this->id = $id;
        $this->nameOfPublicationHouse = $nameOfPublicationHouse;
        $this->yearOfCreation = $yearOfCreation;
        $this->ownerOfPublicationHouse = $ownerOfPublicationHouse;
        $this->book = new ArrayCollection($book);
    }

    /**
     * @return Collection|Book[]
     */
    public function getBook()
    {
        return $this->book;
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
    public function getNameOfPublicationHouse(): string
    {
        return $this->nameOfPublicationHouse;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getYearOfCreation(): DateTimeImmutable
    {
        return $this->yearOfCreation;
    }

    /**
     * @return string
     */
    public function getOwnerOfPublicationHouse(): string
    {
        return $this->ownerOfPublicationHouse;
    }


}