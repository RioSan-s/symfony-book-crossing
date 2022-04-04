<?php

namespace NonEfTech\BookCrossing\Entity;

use Doctrine\ORM\Mapping as ORM;
use NonEfTech\BookCrossing\Exception\InvalidDataStructureException;

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
    /**
     * Создает сущность "Акт" из массива
     *
     * @param array $data
     *
     * @return AbstractAct
     */

    public static function createFromArray(array $data): AbstractAct
    {
        $requiredFields = [
            'id',
            'book',
            'count',
            'participant',


        ];

        $missingFields = array_diff($requiredFields, array_keys($data));

        if (count($missingFields) > 0) {
            $errMsg = sprintf("Отсутствуют обязательные элементы: %s", implode(',', $missingFields));
            throw new InvalidDataStructureException($errMsg);
        }


        return new ActOfTaking($data['id'], $data['book'], $data['count'], $data['participant']);
    }


}
