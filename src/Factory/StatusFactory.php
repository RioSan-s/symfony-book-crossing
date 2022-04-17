<?php

namespace NonEfTech\BookCrossing\Factory;

use Doctrine\ORM\EntityManagerInterface;
use NonEfTech\BookCrossing\Entity\BlackListStatus\Status;
use NonEfTech\BookCrossing\Entity\BlackListStatus\StatusFactoryInterface;

class StatusFactory implements StatusFactoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function findOneBy(string $name): ?Status
    {
        return $this->entityManager->getRepository(Status::class)->findOneBy(['name' => $name]);
    }
}