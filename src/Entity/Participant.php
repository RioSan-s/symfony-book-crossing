<?php

namespace NonEfTech\BookCrossing\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Участник обмена
 *  * @ORM\Entity(repositoryClass=\NonEfTech\BookCrossing\Repository\ParticipantDoctrineRepository::class)
 * @ORM\Table(name="participants",
 *      uniqueConstraints=
 *     {
 *     @ORM\UniqueConstraint(name="participants_email_unq", columns={"email"})
 *     })
 */
class Participant extends AbstractUsers
{
    /**
     * email участника обмена
     * @ORM\Column(name="email",type="string",nullable = false,length=50)
     * @var string
     */
    private string $email;

    /**
     * @ORM\OneToMany(targetEntity=\NonEfTech\BookCrossing\Entity\AbstractAct::class, mappedBy="participant")
     * @var Collection|AbstractAct[]
     */
    private Collection $acts;


    /**
     * @param int               $id
     * @param string            $fio
     * @param string            $phoneNumber
     * @param DateTimeImmutable $dateOfBirth
     * @param string            $email
     * @param array             $acts
     */
    public function __construct(
        int $id,
        string $fio,
        string $phoneNumber,
        DateTimeImmutable $dateOfBirth,
        string $email,
        array $acts = []
    ) {
        parent::__construct($id, $fio, $phoneNumber, $dateOfBirth);
        $this->email = $email;
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
     * Создает сущность "Пользователь" из массива
     *
     * @param array $data
     *
     * @return Participant
     */
    public static function createFromArray(array $data): Participant
    {
        $requiredFields = [
            'id',
            'fio',
            'phoneNumber',
            'dateOfBirth',
            'email',


        ];
        $missingFields = array_diff($requiredFields, array_keys($data));

        if (count($missingFields) > 0) {
            $errMsg = sprintf("Отсутствуют обязательные элементы: %s", implode(',', $missingFields));
            throw new InvalidDataStructureException($errMsg);
        }


        return new Participant($data['id'], $data['fio'], $data['phoneNumber'], $data['dateOfBirth'], $data['email']);
    }

    /**
     * Возвращает email участника обмена
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
