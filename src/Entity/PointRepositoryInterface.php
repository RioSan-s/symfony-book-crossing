<?php

namespace NonEfTech\BookCrossing\Entity;

interface PointRepositoryInterface
{
    /**
     * Поиск сущностей по заданному критерию
     *
     * @param array $criteria
     *
     * @return Point[]
     */
    public function findBy(array $criteria): array;
}
