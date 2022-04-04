<?php

namespace NonEfTech\BookCrossing\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Акт обмена(отдачи/взятия)
 * @ORM\MappedSuperclass()
 * @ORM\Table( name="acts",
 *     indexes=
 *     {
 *     @ORM\Index(name="acts_book_id_idx",columns={"book_id"}),
 *     @ORM\Index(name="acts_participant_id_idx",columns={"participant_id"})
 *    })
 *
 */
abstract class AbstractAct
{
    /**
     * id акта обмена
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable = false)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="act_of_taking_id_seq")
     * @var int
     */
    private int $id;

    /**
     * Книга, участвующая в акте обмена
     * @ORM\ManyToOne(targetEntity=\NonEfTech\BookCrossing\Entity\Book::class, inversedBy="acts",cascade={"persist"})
     * @ORM\JoinColumn(name="book_id",referencedColumnName="id")
     * @var Book
     */
    private Book $book;

    /**
     * Количество книг, участвующих в обмене
     * @ORM\Column(name="count", type="integer", nullable = false)
     * @var int
     */
    private int $count;

    /**
     * Участник обмена
     * @ORM\ManyToOne(targetEntity=\NonEfTech\BookCrossing\Entity\Participant::class, inversedBy="acts",cascade={"persist"})
     * @ORM\JoinColumn(name="participant_id",referencedColumnName="id")
     * @var Participant
     */
    private Participant $participant;

    /**
     * @param int         $id          - id акта обмена
     * @param Book        $book        - книга, участвующая в обмене
     * @param int         $count       - количество книг, участвующих в обмене
     * @param Participant $participant - участник обмена
     */
    public function __construct(int $id, Book $book, int $count, Participant $participant)
    {
        $this->id = $id;
        $this->book = $book;
        $this->count = $count;
        $this->participant = $participant;
    }

    /**
     * Возвращает id акта обмена
     *
     * @return int
     */
    final public function getId(): int
    {
        return $this->id;
    }

    /**
     * Возвращает книгу, участвующую в акте обмена
     *
     * @return Book
     */
    final public function getBook(): Book
    {
        return $this->book;
    }

    /**
     * Возвращает количество книг, участвующих в акте обмена
     *
     * @return int
     */
    final public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Возвращает участника обмена
     *
     * @return Participant
     */
    final public function getParticipant(): Participant
    {
        return $this->participant;
    }
}
