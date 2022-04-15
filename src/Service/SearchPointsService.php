<?php

namespace NonEfTech\BookCrossing\Service;

use DateTimeImmutable;
use NonEfTech\BookCrossing\Entity\Point;
use NonEfTech\BookCrossing\Entity\PointRepositoryInterface;
use NonEfTech\BookCrossing\Service\SearchPointsService\PointsDto;
use NonEfTech\BookCrossing\Service\SearchPointsService\SearchPointsCriteria;
use Psr\Log\LoggerInterface;

final class SearchPointsService
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
     * @var PointRepositoryInterface
     */
    private PointRepositoryInterface $pointRepository;

    /**
     * @param LoggerInterface $logger
     * @param PointRepositoryInterface $pointRepository
     */
    public function __construct(
        LoggerInterface $logger,
        PointRepositoryInterface $pointRepository
    ) {
        $this->logger = $logger;

        $this->pointRepository = $pointRepository;
    }


    public function search(SearchPointsCriteria $searchCriteria): array
    {
        $criteria = $this->searchCriteriaToArray($searchCriteria);
        $entitiesCollection = $this->pointRepository->findBy($criteria);
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
     * @param SearchPointsCriteria $searchCriteria
     *
     * @return array
     */
    private function searchCriteriaToArray(SearchPointsCriteria $searchCriteria): array
    {
        $criteriaForRepository = [
            'id' => $searchCriteria->getId(),
            'phone_number' => $searchCriteria->getPhoneNumber(),
            'country' => $searchCriteria->getCountry(),
            'city' => $searchCriteria->getCity(),
            'street' => $searchCriteria->getStreet(),
            'home' => $searchCriteria->getHome(),
            'flat' => $searchCriteria->getFlat(),

            'startTime' => is_bool(DateTimeImmutable::createFromFormat('H:i', $searchCriteria->getStartTime()))? null :
                DateTimeImmutable::createFromFormat('H:i', $searchCriteria->getStartTime()),

            'endTime' => is_bool(DateTimeImmutable::createFromFormat('H:i', $searchCriteria->getEndTime())) ? null :
                DateTimeImmutable::createFromFormat('H:i', $searchCriteria->getEndTime())

        ];
        return array_filter($criteriaForRepository, static function ($v): bool {
            return null !== $v;
        });
    }

    /**
     * Создание дто по пунктам обмена
     *
     * @param Point $point
     *
     * @return PointsDto
     */
    private function createDto(Point $point): PointsDto
    {
        return new PointsDto(
            $point->getId(),
            $point->getPhoneNumber()->getPhoneNumber(),
            $point->getAddress()->getCountry(),
            $point->getAddress()->getCity(),
            $point->getAddress()->getStreet(),
            $point->getAddress()->getHome(),
            $point->getAddress()->getFlat(),
            $point->getStartTime()->format('H:i'),
            $point->getEndTime()->format('H:i')
        );
    }
}
