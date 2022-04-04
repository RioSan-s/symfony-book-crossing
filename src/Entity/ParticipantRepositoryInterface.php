<?php

namespace NonEfTech\BookCrossing\Entity;

interface ParticipantRepositoryInterface
{
    /**
     * Поиск сущностей по заданному критерию
     *
     * @param array $criteria
     *
     * @return Participant[]
     */
    public function findBy(array $criteria): array;
}
