<?php

namespace NonEfTech\BookCrossing\Service;

use NonEfTech\BookCrossing\Entity\BlackList;
use NonEfTech\BookCrossing\Entity\BlackListInterface;
use NonEfTech\BookCrossing\Exception\RuntimeException;
use NonEfTech\BookCrossing\Service\ChangeDescriptionBlackListService\UpdateDescriptionDto;

class ChangeDescriptionBlackListService
{
    private BlackListInterface $blackListDoctrineRepository;

    /**
     * @param BlackListInterface $blackListDoctrineRepository
     */
    public function __construct(BlackListInterface $blackListDoctrineRepository)
    {
        $this->blackListDoctrineRepository = $blackListDoctrineRepository;
    }

    public function updateDescription(int $blackListId, string $description): UpdateDescriptionDto
    {
        $entities = $this->blackListDoctrineRepository->findBy(['id' => $blackListId],);
        if (1 !== count($entities)) {
            throw new RuntimeException("Не удалось найти пользователя в black list. Запись с id = $blackListId не найдена"
            );
        }
        /** @var BlackList $entity */
        $entity = current($entities);
        if($entity->getDescription()===$description)
        {
            throw new RuntimeException("Описание для записи c id {$entity->getId()}: '$description' уже установлено");
        }

        $entity->updateDescription($description);

        return new UpdateDescriptionDto(
            $entity->getId(),
            $entity->getDescription(),
            $entity->getStatus()
                ->getName(),
            $entity->getParticipant()
                ->getId(),
            $entity->getDate()
        );
    }

}