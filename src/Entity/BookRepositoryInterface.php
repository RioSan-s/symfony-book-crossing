<?php

namespace NonEfTech\BookCrossing\Entity;

interface BookRepositoryInterface
{
    /**
     * Поиск сущностей по заданному критерию
     *
     * @param array $criteria
     *
     * @return Book[]
     */
    public function findBy(array $criteria): array;
}
