<?php

namespace NonEfTech\BookCrossing\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use NonEfTech\BookCrossing\Entity\Book;
use NonEfTech\BookCrossing\Entity\BookRepositoryInterface;



/**
 * Репозиторий книг в доктрине
 */
class BookDoctrineRepository extends EntityRepository implements BookRepositoryInterface
{
    private const REPLACED_CRITERIA = [
        'country' => 'address.country',
        'city' => 'address.city',
        'street' => 'address.street',
        'home' => 'address.home',
        'flat' => 'address.flat',
        'phoneNumber'=>'phoneNumber.phoneNumber'

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
            ->leftJoin('b.publishingHouse', 'ph');
        $this->buildWhere($queryBuilder, $criteria);

        return $queryBuilder->orderBy('b.id')
            ->getQuery()
            ->getResult();
    }

    /**
     * Формируем условия поиска в запосе, на основе критериев
     *
     * @param QueryBuilder $queryBuilder
     * @param array $criteria
     *
     * @return void
     */
    private function buildWhere(QueryBuilder $queryBuilder, array $criteria): void
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
                $criteriaName = substr($criteriaName, 3);
                $whereExprAnd->add(
                    $queryBuilder->expr()
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
        $queryBuilder->setParameter($criteriaName, $criteriaValue);
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
