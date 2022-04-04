<?php

namespace NonEfTech\BookCrossing\Entity;

/**
 * Интерфейс репозитория для сущности Администратор
 */
interface AdministratorRepositoryInterface
{
    /**
     * Поиск сущностей по заданному критерию
     *
     * @param array $criteria
     *
     * @return Administrator[]
     */
    public function findBy(array $criteria): array;

    /**
     * Поиск пользователя по логинам
     *
     * @param string $login - логин пользователя
     *
     * @return Administrator|null - сущность пользователя
     */
    public function findUserByLogin(string $login): ?Administrator;
}
