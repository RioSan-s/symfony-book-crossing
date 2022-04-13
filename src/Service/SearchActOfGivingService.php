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
            'book_publishingHouse'   => $searchCriteria->getPublishingHouse(),
            'book_yearOfPublication' => $searchCriteria->getYearOfPublication(),
            'point_id'          => $searchCriteria->getPointId(),
            'point_phoneNumber' => $searchCriteria->getPointPhoneNumber(),
            'point_address'     => $searchCriteria->getPointAddress(),
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
        $point = $actOfGiving->getBook()
            ->getPoint();
        $participant = $actOfGiving->getParticipant();
        $pointsDto = new PointsDto(
            $point->getId(),
            $point->getPhoneNumber(),
            "{$point->getAddress()->getCountry()}, г. {$point->getAddress()->getCity()}, {$point->getAddress()->getStreet()} ул., д. {$point->getAddress()->getHome()} кв.{$point->getAddress()->getFlat()}",
            $point->getStartTime()->format('H:i'),
            $point->getEndTime()->format('H:i')
        );
        $booksDto = new BooksDto(
            $book->getId(),
            $book->getTitle(),
            $book->getAuthor(),
            $book->getPublishingHouse(),
            $book->getYearOfPublication()->format('Y'),
            $pointsDto,
            $book->getPurchasePrices()
        );
        $participantsDto = new ParticipantsDto(
            $participant->getId(),
            $participant->getFio(),
            $participant->getPhoneNumber(),
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
