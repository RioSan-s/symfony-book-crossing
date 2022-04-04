<?php

namespace NonEfTech\BookCrossing\Repository;

use Doctrine\ORM\EntityRepository;

use NonEfTech\BookCrossing\Entity\ActOfTaking;

class ActOfTakingDoctrineRepository extends EntityRepository implements
    \NonEfTech\BookCrossing\Entity\ActOfTakingRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null): array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select(['at','b','pt','p'])
            ->from(ActOfTaking::class, 'at')
            ->join('at.book', 'b')->leftJoin('b.point', 'p')
            ->leftJoin('at.participant', 'pt');
        $this->buildWhere($queryBuilder, $criteria);

        return $queryBuilder->orderBy('at.id')->getQuery()
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
            if (0 === strpos($criteriaName, 'book_')) {
                $criteriaName = substr($criteriaName, 5);
                $whereExprAnd->add(
                    $queryBuilder->expr()
                        ->eq("b.$criteriaName", ":$criteriaName")
                );
            } elseif (0 === strpos($criteriaName, 'point_')) {
                $criteriaName = substr($criteriaName, 6);
                $whereExprAnd->add(
                    $queryBuilder->expr()
                        ->eq("p.$criteriaName", ":$criteriaName")
                );
            } elseif (0 === strpos($criteriaName, 'participant_')) {
                $criteriaName = substr($criteriaName, 12);
                $whereExprAnd->add(
                    $queryBuilder->expr()
                        ->eq("pt.$criteriaName", ":$criteriaName")
                );
            } else {
                $whereExprAnd->add(
                    $queryBuilder->expr()
                        ->eq("at.$criteriaName", ":$criteriaName")
                );
            }
        }
        $queryBuilder->where($whereExprAnd);
        $queryBuilder->setParameter($criteriaName, $criteriaValue);
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
    public function add(ActOfTaking $entity): ActOfTaking
    {
        $this->getEntityManager()->persist($entity);
        return $entity;
    }
}