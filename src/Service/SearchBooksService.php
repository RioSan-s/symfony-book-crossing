<?php

namespace NonEfTech\BookCrossing\Service;

use DateTimeImmutable;
use NonEfTech\BookCrossing\Entity\Book;
use NonEfTech\BookCrossing\Entity\BookRepositoryInterface;
use NonEfTech\BookCrossing\Service\SearchBooksService\BooksDto;
use NonEfTech\BookCrossing\Service\SearchBooksService\PointsDto;
use NonEfTech\BookCrossing\Service\SearchBooksService\PublicationHouseDto;
use NonEfTech\BookCrossing\Service\SearchBooksService\SearchBooksCriteria;
use Psr\Log\LoggerInterface;

final class SearchBooksService
{
    /**
     * Логер
     *
     * @var LoggerInterface
     */
    private LoggerInterface $logger;


    /**
     * Репозиторий для работы с книгами
     *
     * @var BookRepositoryInterface
     */
    private BookRepositoryInterface $bookRepository;

    /**
     * @param LoggerInterface $logger
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(
        LoggerInterface $logger,
        BookRepositoryInterface $bookRepository
    ) {
        $this->logger = $logger;

        $this->bookRepository = $bookRepository;
    }


    public function search(SearchBooksCriteria $searchCriteria): array
    {
        $criteria = $this->searchCriteriaToArray($searchCriteria);
        $entitiesCollection = $this->bookRepository->findBy($criteria);
        $dtoCollection = [];
        foreach ($entitiesCollection as $entity) {
            $dtoCollection[] = $this->createDto($entity);
        }
        $this->logger->debug(
            'found books: ' . count($entitiesCollection)
        );
        return $dtoCollection;
    }

    /**
     * Приобразует критериии поиска в массив
     *
     * @param SearchBooksCriteria $searchCriteria
     *
     * @return array
     */
    private function searchCriteriaToArray(SearchBooksCriteria $searchCriteria): array
    {
        $criteriaForRepository = [
            'id' => $searchCriteria->getId(),
            'title' => $searchCriteria->getTitle(),
            'author' => $searchCriteria->getAuthor(),
            'ph_publishingHouse' => $searchCriteria->getNameOfPublicationHouse(),
            'yearOfPublication' => $searchCriteria->getYearOfPublication(),
            'point_id' => $searchCriteria->getPointId(),
            'point_phoneNumber' => $searchCriteria->getPhoneNumber(),
            'point_country' => $searchCriteria->getPointCountry(),
            'point_city' => $searchCriteria->getPointCity(),
            'point_street' => $searchCriteria->getPointStreet(),
            'point_home' => $searchCriteria->getPointHome(),
            'point_flat' => $searchCriteria->getPointFlat(),
            'point_startTime' => $searchCriteria->getStartTime(),
            'point_endTime' => $searchCriteria->getEndTime(),

        ];
        return array_filter($criteriaForRepository, static function ($v): bool {
            return null !== $v;
        });
    }

    /**
     * Создание дто по книгам
     *
     * @param Book $book
     *
     * @return BooksDto
     */
    private function createDto(Book $book): BooksDto
    {
        $point = $book->getPoint();
        $publishingHouse = $book->getPublishingHouse();
        $publishingHouse = new PublicationHouseDto(
            $publishingHouse->getId(),
            $publishingHouse->getNameOfPublicationHouse(),
            $publishingHouse->getYearOfCreation(),
            $publishingHouse->getOwnerOfPublicationHouse()
        );

        $pointsDto = new PointsDto(
            $point->getId(),
            $point->getPhoneNumber(),
            $point->getAddress()->getCountry(),
            $point->getAddress()->getCity(),
            $point->getAddress()->getStreet(),
            $point->getAddress()->getHome(),
            $point->getAddress()->getFlat(),
            $point->getStartTime()->format('H:i'),
            $point->getEndTime()->format('H:i')
        );

        return new BooksDto(
            $book->getId(),
            $book->getTitle(),
            $book->getAuthor(),
            $publishingHouse,
            $book->getYearOfPublication()->format('Y'),
            $pointsDto,
            $book->getPurchasePrices()
        );
    }
}
