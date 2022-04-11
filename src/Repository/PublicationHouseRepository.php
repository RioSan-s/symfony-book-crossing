<?php

namespace NonEfTech\BookCrossing\Repository;

use Doctrine\ORM\EntityRepository;
use NonEfTech\BookCrossing\Entity\PublicationHouseInterface;

/**
 * Репозиторий для хранения данных о публикации
 */
class PublicationHouseRepository extends EntityRepository implements PublicationHouseInterface
{
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null):array
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset); // TODO: Change the autogenerated stub
    }

}