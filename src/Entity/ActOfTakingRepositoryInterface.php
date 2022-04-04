<?php

namespace NonEfTech\BookCrossing\Entity;

interface ActOfTakingRepositoryInterface
{
    /**
     * Поиск сущностей по заданному критерию
     *
     * @param array $criteria
     *
     * @return ActOfTaking[]
     */
    public function findBy(array $criteria): array;

    /**
     * Возвращает id для создания
     */
    public function nextId(): int;

    /**
     * Добавляет новую сущность
     *
     * @param ActOfTaking $entity
     *
     * @return ActOfTaking
     */
    public function add(ActOfTaking $entity): ActOfTaking;
}
