<?php

namespace NonEfTech\BookCrossing\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity(repositoryClass=\NonEfTech\BookCrossing\Repository\ActOfGivingDoctrineRepository::class)
 * @ORM\Table(name="act_of_giving",
 *     indexes=
 *     {
 *     @ORM\Index(name="act_of_giving_book_id_idx",columns={"book_id"}),
 *     @ORM\Index(name="act_of_giving_participant_id_idx",columns={"participant_id"})
 *    })
 * Сущность Акта взятия
 */
class ActOfGiving extends AbstractAct
{

}
