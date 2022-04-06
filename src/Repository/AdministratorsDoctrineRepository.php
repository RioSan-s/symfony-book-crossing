<?php

namespace NonEfTech\BookCrossing\Repository;


use Doctrine\ORM\EntityRepository;
use NonEfTech\BookCrossing\Entity\Administrator;
use NonEfTech\BookCrossing\Entity\AdministratorRepositoryInterface;
use NonEfTech\BookCrossing\Exception\RuntimeException;


class AdministratorsDoctrineRepository extends EntityRepository implements
    AdministratorRepositoryInterface

{


    /**
     * @inheritDoc
     */
    public function findUserByLogin(string $login): ?Administrator
    {
        $entities = $this->findBy(['login' => $login]);
        $countEntities = count($entities);
        if ($countEntities > 1) {
            throw new RuntimeException("Найдены пользователи с дублирующимися логинами");
        }

        return 0 === $countEntities ? null : current($entities);
    }


    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null):array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select(['a','p'])
            ->from(Administrator::class, 'a')
            ->leftJoin('a.point', 'p');
        $this->buildWhere($queryBuilder, $criteria);

        return $queryBuilder->getQuery()
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
                        ->eq("a.$criteriaName", ":$criteriaName")
                );
            }
        }
        $queryBuilder->where($whereExprAnd);
        $queryBuilder->setParameter($criteriaName, $criteriaValue);
    }


}
