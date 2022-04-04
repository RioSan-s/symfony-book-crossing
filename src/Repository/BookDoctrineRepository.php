<?php

namespace NonEfTech\BookCrossing\Repository;

use Doctrine\ORM\EntityRepository;
use NonEfTech\BookCrossing\Entity\Book;
use NonEfTech\BookCrossing\Entity\BookRepositoryInterface;

/**
 * Репозиторий книг в доктрине
 */
class BookDoctrineRepository extends EntityRepository implements BookRepositoryInterface
{


    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null): array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select(['b','p'])
            ->from(Book::class, 'b')
            ->leftJoin('b.point', 'p');
        $this->buildWhere($queryBuilder, $criteria);

        return $queryBuilder->orderBy('b.id')->getQuery()
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
            if (0 === strpos($criteriaName, 'point_')) {
                $criteriaName = substr($criteriaName, 6);
                $whereExprAnd->add(
                    $queryBuilder->expr()
                        ->eq("p.$criteriaName", ":$criteriaName")
                );

            } else {
                $whereExprAnd->add(
                    $queryBuilder->expr()
                        ->eq("b.$criteriaName", ":$criteriaName")
                );
            }
        }
        $queryBuilder->where($whereExprAnd);
        $queryBuilder->setParameter($criteriaName, $criteriaValue);
    }
}
