<?php

namespace NonEfTech\BookCrossing\Entity;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use NonEfTech\BookCrossing\Entity\BlackListStatus\Status;
use NonEfTech\BookCrossing\Exception\RuntimeException;

/**
 * @ORM\Entity(repositoryClass=\NonEfTech\BookCrossing\Repository\BlackListDoctrineRepository::class)
 * Сущность блек лист
 * @ORM\Table(name="blacklist")
 */
class BlackList
{
    /**
     * id blacklist
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable = false)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="blacklist_id_seq")
     * @var int
     */
    private int $id;

    /**
     * Описание причины бана
     * @ORM\Column(name="description", type="string", nullable = false, length=255)
     * @var string
     */
    private string $description;

    /**
     * Статус бана
     * @ORM\ManyToOne(targetEntity=\NonEfTech\BookCrossing\Entity\BlackListStatus\Status::class, cascade={"persist"})
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     * @var Status
     */
    private Status $status;

    /**
     * пользователь
     * @ORM\ManyToOne(targetEntity=\NonEfTech\BookCrossing\Entity\Participant::class)
     * @ORM\JoinColumn(name="participant_id",referencedColumnName="id")
     * @var Participant
     */
    private Participant $participant;

    /**
     * @ORM\Column(name="date", type="datetime_immutable", nullable=false)
     *
     * Дата изменения
     *
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $date;

    /**
     * @param int $id
     * @param Participant $participant
     * @param string $description
     * @param Status $status
     * @param DateTimeImmutable $date
     */
    public function __construct(
        int $id,
        Participant $participant,
        string $description,
        Status $status,
        DateTimeImmutable $date

    )
    {
        $this->id = $id;
        $this->participant = $participant;
        $this->description = $description;
        $this->status = $status;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }


    /**
     * @return Participant
     */
    public function getParticipant(): Participant
    {
        return $this->participant;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function updateDescription(string $description): self
    {

        $this->description= $description;
        return $this;
    }



}