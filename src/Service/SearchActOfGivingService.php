<?php

namespace NonEfTech\BookCrossing\Service;

use DateTimeImmutable;
use NonEfTech\BookCrossing\Entity\ActOfGiving;
use NonEfTech\BookCrossing\Entity\ActOfGivingRepositoryInterface;
use NonEfTech\BookCrossing\Service\SearchActOfGivingService\ActOfGivingDto;
use NonEfTech\BookCrossing\Service\SearchActOfGivingService\BooksDto;
use NonEfTech\BookCrossing\Service\SearchActOfGivingService\ParticipantsDto;
use NonEfTech\BookCrossing\Service\SearchActOfGivingService\PointsDto;
use NonEfTech\BookCrossing\Service\SearchActOfGivingService\SearchActOfGivingCriteria;
use NonEfTech\BookCrossing\Service\SearchActOfTakingService\PublicationHouseDto;
use Psr\Log\LoggerInterface;

class SearchActOfGivingService
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
     * @var ActOfGivingRepositoryInterface
     */
    private ActOfGivingRepositoryInterface $actOfGivingRepository;


    /**
     * @param LoggerInterface                $logger
     * @param ActOfGivingRepositoryInterface $actOfGivingRepository
     */
    public function __construct(
        LoggerInterface $logger,
        ActOfGivingRepositoryInterface $actOfGivingRepository
    )
    {
        $this->logger = $logger;

        $this->actOfGivingRepository = $actOfGivingRepository;
    }

    public function search(SearchActOfGivingCriteria $searchCriteria): array
    {
        $criteria = $this->searchCriteriaToArray($searchCriteria);
        $entitiesCollection = $this->actOfGivingRepository->findBy($criteria);
        $dtoCollection = [];
        foreach ($entitiesCollection as $entity) {
            $dtoCollection[] = $this->createDto($entity);
        }
        $this->logger->debug(
            'found actOfGiving: ' . count($entitiesCollection)
        );
        return $dtoCollection;
    }

    private function searchCriteriaToArray(SearchActOfGivingCriteria $searchCriteria)
    {
        $criteriaForRepository = [

            'id'                => $searchCriteria->getId(),
            'book_id'           => $searchCriteria->getBookId(),
            'book_title'             => $searchCriteria->getTitle(),
            'book_author'            => $searchCriteria->getAuthor(),
            'ph_nameOfPublicationHouse' => $searchCriteria->getPhNameOfPublicationHouse(),
            'book_yearOfPublication' => $searchCriteria->getYearOfPublication(),
            'point_id'          => $searchCriteria->getPointId(),
            'point_phoneNumber' => $searchCriteria->getPointPhoneNumber(),
            'point_country' => $searchCriteria->getPointCountry(),
            'point_city' => $searchCriteria->getPointCity(),
            'point_street' => $searchCriteria->getPointStreet(),
            'point_home' => $searchCriteria->getPointHome(),
            'point_flat' => $searchCriteria->getPointFlat(),
            'point_startTime'   => $searchCriteria->getPointStartTime(),
            'point_endTime'     => $searchCriteria->getPointEndTime(),
            'count'             => $searchCriteria->getCount(),
            'participant_id'    => $searchCriteria->getParticipantId(),
            'participant_fio'               => $searchCriteria->getFio(),
            'participant_phoneNumber'       => $searchCriteria->getPhoneNumber(),
            'participant_dateOfBirth'       => $searchCriteria->getDateOfBirth(),
            'participant_email'             => $searchCriteria->getEmail(),

        ];
        return array_filter($criteriaForRepository, static function ($v): bool {
            return null !== $v;
        });
    }

    /**
     * Создание дто по актам отдачи
     *
     * @param ActOfGiving $actOfGiving
     *
     * @return ActOfGivingDto
     */
    private function createDto(ActOfGiving $actOfGiving): ActOfGivingDto
    {
        $book = $actOfGiving->getBook();
        $publishingHouse = $book->getPublishingHouse();
        $point = $actOfGiving->getBook()
            ->getPoint();
        $participant = $actOfGiving->getParticipant();
        $pointsDto = new PointsDto(
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
        $booksDto = new BooksDto(
            $book->getId(),
            $book->getTitle(),
            $book->getAuthor(),
            new PublicationHouseDto(
                $publishingHouse->getId(),
                $publishingHouse->getNameOfPublicationHouse(),
                $publishingHouse->getYearOfCreation(),
                $publishingHouse->getOwnerOfPublicationHouse()
            ),
            $book->getYearOfPublication()->format('Y'),
            $pointsDto,
            $book->getPurchasePrices()
        );
        $participantsDto = new ParticipantsDto(
            $participant->getId(),
            $participant->getFio(),
            $participant->getPhoneNumber()->getPhoneNumber(),
            $participant->getDateOfBirth(),
            $participant->getEmail(),
        );
        return new ActOfGivingDto(
            $actOfGiving->getId(),
            $booksDto,
            $actOfGiving->getCount(),
            $participantsDto
        );
    }
}
