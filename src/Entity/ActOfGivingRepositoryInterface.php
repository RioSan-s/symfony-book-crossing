<?php

namespace NonEfTech\BookCrossing\Entity;

interface ActOfGivingRepositoryInterface
{
    /**
     * Поиск сущностей по заданному критерию
     *
     * @param array $criteria
     *
     * @return ActOfGiving[]
     */
    public function findBy(array $criteria): array;
}
