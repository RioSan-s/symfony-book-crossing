<?php

namespace NonEfTech\BookCrossing\DoctrineEventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\UnitOfWork;
use NonEfTech\BookCrossing\Entity\BlackList;
use NonEfTech\BookCrossing\Entity\BlackListStatus\Status;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Подписчик на события связанные с сущностями
 */
class EntityEventSubscriber implements EventSubscriber
{

    /**
     * @inheritDoc
     */
    public function getSubscribedEvents(): array
    {
        return [Events::onFlush];
    }

    public function onFlush(OnFlushEventArgs $args): void
    {
        $uow = $args->getEntityManager()->getUnitOfWork();
        $entitiesForInsert = $uow->getScheduledEntityInsertions();
        $em = $args->getEntityManager();
        foreach ($entitiesForInsert as $entityForInsert) {
            $this->dispatchInsertStatus($entityForInsert, $uow);
            $this->dispatchInsertBlackList($entityForInsert, $uow, $em);
        }
    }


    private function dispatchInsertStatus($entityForInsert, UnitOfWork $uow): void
    {
        if ($entityForInsert instanceof Status) {
            $uow->scheduleForDelete($entityForInsert);
        }
    }


    private function dispatchInsertBlackList(
        object $entityForInsert,
        UnitOfWork $uow,
        EntityManagerInterface $em
    ) {
        if ($entityForInsert instanceof BlackList) {
            $oldStatus = $entityForInsert->getStatus();
            $entityStatus = $em->getRepository(Status::class)
                ->findOneBy(['name' => $oldStatus->getName()]);
            $uow->propertyChanged(
                $entityForInsert,
                'status',
                $oldStatus,
                $entityStatus
            );
        }
    }


}