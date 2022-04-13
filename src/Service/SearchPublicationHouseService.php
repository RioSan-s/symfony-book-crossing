<?php

namespace NonEfTech\BookCrossing\Service;

use NonEfTech\BookCrossing\Entity\PublicationHouse;
use NonEfTech\BookCrossing\Entity\PublicationHouseInterface;
use NonEfTech\BookCrossing\Service\SearchPublicationHouseService\PublicationHouseDto;
use NonEfTech\BookCrossing\Service\SearchPublicationHouseService\SearchPublicationHouseCriteria;
use Psr\Log\LoggerInterface;

final class SearchPublicationHouseService
{
    /**
     * Логер
     *
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * Репозиторий для работы с пунтками обмена
     *
     * @var PublicationHouseInterface
     */
    private PublicationHouseInterface $publicationHouse;

    /**
     * @param LoggerInterface           $logger
     * @param PublicationHouseInterface $publicationHouse
     */
    public function __construct(LoggerInterface $logger, PublicationHouseInterface $publicationHouse)
    {
        $this->logger = $logger;
        $this->publicationHouse = $publicationHouse;
    }

    public function search(SearchPublicationHouseCriteria $searchCriteria): array
    {
        $criteria = $this->searchCriteriaToArray($searchCriteria);
        $entitiesCollection = $this->publicationHouse->findBy($criteria);
        $dtoCollection = [];
        foreach ($entitiesCollection as $entity) {
            $dtoCollection[] = $this->createDto($entity);
        }
        $this->logger->debug(
            'found points: ' . count($entitiesCollection)
        );
        return $dtoCollection;
    }

    /**
     * Приобразует критериии поиска в массив
     *
     * @param SearchPublicationHouseCriteria $searchCriteria
     *
     * @return array
     */
    private function searchCriteriaToArray(SearchPublicationHouseCriteria $searchCriteria): array
    {
        $criteriaForRepository = [
            'id' => $searchCriteria->getId(),
            'name_of_publication_house' => $searchCriteria->getNameOfPublicationHouse(),
            'year_of_creation' => $searchCriteria->getYearOfCreation(),
            'owner_of_publication_house' =>$searchCriteria->getOwnerOfPublicationHouse()
        ];
        return array_filter($criteriaForRepository, static function ($v): bool {
            return null !== $v;
        });
    }

    /**
     * Создание дто по пунктам обмена
     *
     * @param PublicationHouse $publicationHouse
     *
     * @return PublicationHouseDto
     */
    private function createDto(PublicationHouse $publicationHouse): PublicationHouseDto
    {
        return new PublicationHouseDto(
            $publicationHouse->getId(),
            $publicationHouse->getNameOfPublicationHouse(),
            $publicationHouse->getYearOfCreation(),
            $publicationHouse->getOwnerOfPublicationHouse(),
        );
    }
}