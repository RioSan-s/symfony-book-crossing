<?php

namespace NonEfTech\BookCrossing\Repository;

use NonEfTech\BookCrossing\Entity\Participant;
use NonEfTech\BookCrossing\Entity\ParticipantRepositoryInterface;

class ParticipantDoctrineRepository extends \Doctrine\ORM\EntityRepository implements
    ParticipantRepositoryInterface
{
    private const REPLACED_CRITERIA = [
        'phone_number'=>'phoneNumber.phoneNumber'
    ];

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null): array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select(['p'])
            ->from(Participant::class, 'p');
        $this->buildWhere($queryBuilder, $criteria);
        return $queryBuilder->orderBy('p.id')->getQuery()
            ->getResult();
    }



    /**
     * Формируем условия поиска в запосе, на основе критериев
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @param array $criteria
     *
     * @return void
     */
    private function buildWhere(\Doctrine\ORM\QueryBuilder $queryBuilder, array $criteria): void
    {
        if (0 === count($criteria)) {
            return;
        }
        $whereExprAnd = $queryBuilder->expr()
            ->andX();
        foreach ($criteria as $criteriaName => $criteriaValue) {
            $preparedCriteriaName = $this ->preparedCriteriaForParticipant($criteriaName);
            $whereExprAnd->add(
                $queryBuilder->expr()
                    ->eq("p.$preparedCriteriaName", ":$criteriaName")
            );
        }
        $queryBuilder->where($whereExprAnd);
        $queryBuilder->setParameter($criteriaName, $criteriaValue);
    }


    /**
     * Подготовка критериев для поиска авторов
     *
     * @param string $criteriaName
     *
     * @return string
     */
    private function preparedCriteriaForParticipant(string $propertyName): string
    {


        if (array_key_exists($propertyName, self::REPLACED_CRITERIA)) {
            $preparedCriteriaName = self::REPLACED_CRITERIA[$propertyName];
        } else {
            $preparedCriteriaName = $propertyName;
        }
        return $preparedCriteriaName;
    }

}