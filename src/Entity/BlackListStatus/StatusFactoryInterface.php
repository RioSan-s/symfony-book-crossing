<?php

namespace NonEfTech\BookCrossing\Entity\BlackListStatus;

/**
 * Интерфейс по созданию фабрики
 */
interface StatusFactoryInterface
{
    /**
     * Поиск сущности
     * @param string $name
     * @return Status|null
     */
    public function findOneBy(string $name): ?Status;

}