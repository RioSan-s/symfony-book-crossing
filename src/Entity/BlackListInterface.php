<?php

namespace NonEfTech\BookCrossing\Entity;


interface BlackListInterface
{

    /**
     * Поиск сущностей blacklist по заданному критерию
     * @param array $criteria
     * @return BlackList[]
     */
    public function findBy(array $criteria):array;

    /**
     * Возвращает id для создания blacklist
     */
    public function nextId(): int;


    /**
     * Добавление новой сущности blacklist
     * @param BlackList $entity
     * @return BlackList
     */
    public function add(BlackList $entity):BlackList;

}