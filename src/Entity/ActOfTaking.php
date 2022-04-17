<?php

namespace NonEfTech\BookCrossing\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *   @ORM\Entity(repositoryClass=\NonEfTech\BookCrossing\Repository\ActOfTakingDoctrineRepository::class)
 * @ORM\Table(name="act_of_taking",
 *     indexes=
 *     {
 *     @ORM\Index(name="act_of_taking_book_id_idx",columns={"book_id"}),
 *     @ORM\Index(name="act_of_taking_participant_id_idx",columns={"participant_id"}),
 *    }
 * )
 * Сущность Акта взятия
 */
class ActOfTaking extends AbstractAct
{



}
