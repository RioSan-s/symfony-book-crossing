<?php

namespace NonEfTech\BookCrossing\Repository;

use Doctrine\ORM\EntityRepository;
use NonEfTech\BookCrossing\Entity\Book;
use NonEfTech\BookCrossing\Entity\BookRepositoryInterface;

use function Doctrine\ORM\QueryBuilder;

/**
 * Репозиторий книг в доктрине
 */
class BookDoctrineRepository extends EntityRepository implements BookRepositoryInterface
{
    private const REPLACED_CRITERIA = [
        'country' => 'address.country',
        'city'    => 'address.city',
        'street'  => 'address.street',
        'home'    => 'address.home',
        'flat'    => 'address.flat',

    ];

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null): array
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder();
        $queryBuilder->select(['b', 'p', 'ph'])
            ->from(Book::class, 'b')
            ->leftJoin('b.point', 'p')
            ->leftJoin('ph.publicationHouse', 'ph');
        $this->buildWhere($queryBuilder, $criteria);

        return $queryBuilder->orderBy('b.id')
            ->getQuery()
            ->getResult();
    }

    /**
     * Формируем условия поиска в запосе, на основе критериев
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @param array                      $criteria
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
                $preparedCriteria = $this->preparedAddressCriteria($criteriaName);

                $whereExprAnd->add(
                    $queryBuilder->expr()
                        ->eq("p.$preparedCriteria", ":$criteriaName")
                );
            } elseif (0 === strpos($criteriaName, 'ph_')) {
                $whereExprAnd->add($queryBuilder->expr()
                                       ->eq("ph.$criteriaName", ":$criteriaName")
                );
            } else {
                $whereExprAnd->add(
                    $queryBuilder->expr()
                        ->eq("b.$criteriaName", ":$criteriaName")
                );
            }
        }
        $queryBuilder->where($whereExprAnd);
        $queryBuilder->setParameters($criteria);
    }

    private function preparedAddressCriteria(string $key): string
    {
        $propertyName = substr($key, 6);


        if (array_key_exists($propertyName, self::REPLACED_CRITERIA)) {
            $preparedCriteriaName = self::REPLACED_CRITERIA[$propertyName];
        } else {
            $preparedCriteriaName = $propertyName;
        }

        return $preparedCriteriaName;
    }


}
