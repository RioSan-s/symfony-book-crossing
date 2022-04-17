<?php

namespace NonEfTech\BookCrossing\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use NonEfTech\BookCrossing\Entity\BlackList;
use NonEfTech\BookCrossing\Entity\BlackListInterface;

class BlackListDoctrineRepository extends EntityRepository implements
    BlackListInterface
{
    private const REPLACED_CRITERIA = [
        'phoneNumber' => 'phoneNumber.phoneNumber'
    ];

    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null): array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select(['b', 'p'])
            ->from(BlackList::class, 'b')
            ->join('b.participant', 'p');
        $this->buildWhere($queryBuilder, $criteria);
        return $queryBuilder->orderBy("b.id")->getQuery()->getResult();
    }


    /**
     * @inheritDoc
     */
    public function nextId(): int
    {
        return 1;
    }

    /**
     * @inheritDoc
     */
    public function add(BlackList $entity): BlackList
    {
        $this->getEntityManager()->persist($entity);
        return $entity;
    }

    /**
     * Формирование условия поиска
     * @param QueryBuilder $queryBuilder
     * @param array $criteria
     * @return void
     */
    private function buildWhere(QueryBuilder $queryBuilder, array $criteria): void
    {
        if (0 === count($criteria)) {
            return;
        }
        $whereExprAnd = $queryBuilder->expr()->andX();

        foreach ($criteria as $criteriaName => $criteriaValue) {
            if (0 === strpos($criteriaName, 'participant_')) {
                $preparedCriteriaName = $this->preparedCriteriaForParticipant($criteriaName);
                $whereExprAnd->add($queryBuilder->expr()->eq("p.$preparedCriteriaName", ":$criteriaName"));
            } else {
                $whereExprAnd->add($queryBuilder->expr()->eq("b.$criteriaName", ":$criteriaName"));
            }
        }
        $queryBuilder->where($whereExprAnd);
        $queryBuilder->setParameter($criteriaName, $criteriaValue);
    }

    /**
     * Подготовка критериев для поиска авторов
     *
     * @param string $propertyName
     *
     * @return string
     */
    private function preparedCriteriaForParticipant(string $propertyName): string
    {
        $propertyName = substr($propertyName, 12);
        if (array_key_exists($propertyName, self::REPLACED_CRITERIA)) {
            $preparedCriteriaName = self::REPLACED_CRITERIA[$propertyName];
        } else {
            $preparedCriteriaName = $propertyName;
        }
        return $preparedCriteriaName;
    }
}