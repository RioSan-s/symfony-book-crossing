<?php

namespace NonEfTech\BookCrossing\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use NonEfTech\BookCrossing\Exception\DomainException;
use NonEfTech\BookCrossing\ValueObject\PurchasePrice;

/**
 * Книга
 * @ORM\Table(name="books",indexes=
 * {
 *  @ORM\Index(name="books_author_idx", columns ={"author"}),
 *  @ORM\Index(name="books_point_id_idx", columns ={"point_id"}),
 *  @ORM\Index(name="books_publishing_house_idx", columns ={"publishing_house"}),
 *  @ORM\Index(name="books_title_idx", columns ={"title"})
 *     }
 * )
 * @ORM\Entity(repositoryClass=\NonEfTech\BookCrossing\Repository\BookDoctrineRepository::class)
 */
class Book
{
    /**
     * id книги
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable = false)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="books_id_seq")
     * @var int
     */
    private int $id;

    /**
     * Название книги
     * @ORM\Column(name="title", type="string", nullable = false, length=250)
     * @var string
     */
    private string $title;

    /**
     * Имя и фамилия автора книги
     * @ORM\Column(name="author", type="string", nullable = false, length=250)
     * @var string
     */
    private string $author;

    /**
     * Издательство книги
     * @ORM\Column(name="publishing_house", type="string", nullable = false, length=250)
     * @var string
     */
    private string $publishingHouse;

    /**
     * Год публикации книги
     * @ORM\Column(name="year_of_publication", type="date_immutable", nullable = false)
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $yearOfPublication;

    /**
     * Пункт обмена книги
     * @ORM\ManyToOne(targetEntity=\NonEfTech\BookCrossing\Entity\Point::class, inversedBy="book", cascade={"persist"})
     * @ORM\JoinColumn(name="point_id",referencedColumnName="id")
     * @var Point
     */
    private Point $point;

    /**
     * Даные о закупочных ценах
     * @ORM\OneToMany(targetEntity=\NonEfTech\BookCrossing\ValueObject\PurchasePrice::class, mappedBy="book")
     *
     * @var PurchasePrice[]|Collection
     */
    private Collection $purchasePrices;

    /**
     * @ORM\OneToMany(targetEntity=\NonEfTech\BookCrossing\Entity\AbstractAct::class, mappedBy="book")
     * @var Collection|AbstractAct[]
     */
    private Collection $acts;
    /**
     * @param int $id - id книги
     * @param string $title - название книги
     * @param string $author - автор книги
     * @param string $publishingHouse - издательство книги
     * @param DateTimeImmutable $yearOfPublication - год публикации книги
     * @param PurchasePrice[] $purchasePrices
     * @param Point $point - пункт выдачи книги
     * @param AbstractAct|Collection $acts
     */
    public function __construct(
        int $id,
        string $title,
        string $author,
        string $publishingHouse,
        DateTimeImmutable $yearOfPublication,
        array $purchasePrices,
        Point $point,
        array $acts =[]
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->publishingHouse = $publishingHouse;
        $this->yearOfPublication = $yearOfPublication;
        foreach ($purchasePrices as $purchasePrice) {
            if (!$purchasePrice instanceof PurchasePrice) {
                throw new DomainException("Некорректный формат данных о закупочной цене");
            }
        }
        $this->purchasePrices = new ArrayCollection($purchasePrices);
        $this->point = $point;
        $this->acts = new ArrayCollection($acts);
    }

    /**
     * @return Collection|AbstractAct[]
     */
    public function getActs()
    {
        return $this->acts->toArray();
    }


    /**
     * @return PurchasePrice[]
     */
    public function getPurchasePrices(): array
    {
        return $this->purchasePrices->toArray();
    }

    /**
     * Возвращает id книги
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Возвращает название книги
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Возвращает имя и фамилию автора книги
     *
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Возвращает издательство книги
     *
     * @return string
     */
    public function getPublishingHouse(): string
    {
        return $this->publishingHouse;
    }

    /**
     * Возвращает год публикации книги
     *
     * @return DateTimeImmutable
     */
    public function getYearOfPublication(): DateTimeImmutable
    {
        return $this->yearOfPublication;
    }

    /**
     * Возвращает пункт обмена книги
     *
     * @return Point
     */
    public function getPoint(): Point
    {
        return $this->point;
    }
}
