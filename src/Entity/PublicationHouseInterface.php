<?php

namespace NonEfTech\BookCrossing\Entity;

interface PublicationHouseInterface
{
    /**
     * Поиск сущностей по заданному критерию
     *
     * @param array $criteria
     *
     * @return PublicationHouse[]
     */
    public function findBy(array $criteria): array;
}