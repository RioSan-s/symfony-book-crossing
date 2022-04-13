<?php

namespace NonEfTech\BookCrossing\Service;

use DateTimeImmutable;
use NonEfTech\BookCrossing\Entity\ActOfTaking;
use NonEfTech\BookCrossing\Entity\ActOfTakingRepositoryInterface;
use NonEfTech\BookCrossing\Service\SearchActOfTakingService\ActOfTakingDto;
use NonEfTech\BookCrossing\Service\SearchActOfTakingService\BooksDto;
use NonEfTech\BookCrossing\Service\SearchActOfTakingService\ParticipantsDto;
use NonEfTech\BookCrossing\Service\SearchActOfTakingService\PointsDto;
use NonEfTech\BookCrossing\Service\SearchActOfTakingService\SearchActOfTakingCriteria;
use Psr\Log\LoggerInterface;

class SearchActOfTakingService
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
     * @var ActOfTakingRepositoryInterface
     */
    private ActOfTakingRepositoryInterface $actOfTakingRepository;


    /**
     * @param LoggerInterface $logger
     * @param ActOfTakingRepositoryInterface $actOfTakingRepository
     */
    public function __construct(
        LoggerInterface $logger,
        ActOfTakingRepositoryInterface $actOfTakingRepository
    ) {
        $this->logger = $logger;

        $this->actOfTakingRepository = $actOfTakingRepository;
    }

    public function search(SearchActOfTakingCriteria $searchCriteria): array
    {
        $criteria = $this->searchCriteriaToArray($searchCriteria);
        $entitiesCollection = $this->actOfTakingRepository->findBy($criteria);
        $dtoCollection = [];
        foreach ($entitiesCollection as $entity) {
            $dtoCollection[] = $this->createDto($entity);
        }
        $this->logger->debug(
            'found actOfTaking: ' . count($entitiesCollection)
        );
        return $dtoCollection;
    }

    private function searchCriteriaToArray(SearchActOfTakingCriteria $searchCriteria)
    {
        $criteriaForRepository = [

            'id' => $searchCriteria->getId(),
            'book_id' => $searchCriteria->getBookId(),
            'book_title' => $searchCriteria->getTitle(),
            'book_author' => $searchCriteria->getAuthor(),
            'book_publishingHouse' => $searchCriteria->getPublishingHouse(),
            'book_yearOfPublication' => $searchCriteria->getYearOfPublication(),
            'point_id' => $searchCriteria->getPointId(),
            'point_phoneNumber' => $searchCriteria->getPointPhoneNumber(),
            'point_country' => $searchCriteria->getPointCountry(),
            'point_city' => $searchCriteria->getPointCity(),
            'point_street' => $searchCriteria->getPointStreet(),
            'point_home' => $searchCriteria->getPointHome(),
            'point_flat' => $searchCriteria->getPointFlat(),
            'point_startTime' => $searchCriteria->getPointStartTime(),
            'point_endTime' => $searchCriteria->getPointEndTime(),
            'count' => $searchCriteria->getCount(),
            'participant_id' => $searchCriteria->getParticipantId(),
            'participant_fio' => $searchCriteria->getFio(),
            'participant_phoneNumber' => $searchCriteria->getPhoneNumber(),
            'participant_dateOfBirth' => $searchCriteria->getDateOfBirth(),
            'participant_email' => $searchCriteria->getEmail(),

        ];
        return array_filter($criteriaForRepository, static function ($v): bool {
            return null !== $v;
        });
    }

    /**
     * Создание дто по актам отдачи
     *
     * @param ActOfTaking $actOfTaking
     *
     * @return ActOfTakingDto
     */
    private function createDto(ActOfTaking $actOfTaking): ActOfTakingDto
    {
        $book = $actOfTaking->getBook();
        $point = $actOfTaking->getBook()
            ->getPoint();
        $participant = $actOfTaking->getParticipant();
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
        return new ActOfTakingDto(
            $actOfTaking->getId(),
            $booksDto,
            $actOfTaking->getCount(),
            $participantsDto
        );
    }
}
