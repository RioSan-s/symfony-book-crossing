<?php

namespace NonEfTech\BookCrossing\Form;

use NonEfTech\BookCrossing\Service\SearchBooksService;

use NonEfTech\BookCrossing\Service\SearchParticipantsService;

use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type as FormElement;


class CreateActOfTakingForm extends \Symfony\Component\Form\AbstractType
{
    /**
     * Сервис поиска книг
     *
     * @var SearchBooksService
     */
    private SearchBooksService $booksService;

    /**
     * Сервис поиска пользователей
     *
     * @var SearchParticipantsService
     */
    private SearchParticipantsService $participantsService;

    /**
     * @param SearchBooksService $booksService
     * @param SearchParticipantsService $participantsService
     */
    public function __construct(SearchBooksService $booksService, SearchParticipantsService $participantsService)
    {
        $this->booksService = $booksService;
        $this->participantsService = $participantsService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('book_id', FormElement\ChoiceType::class,
            [
                'required' => true,
                'multiple' => false,
                'label' => 'Название книги',
                'choices' => $this->booksService->search(new SearchBooksService\SearchBooksCriteria()),
                'choice_label' => static function (SearchBooksService\BooksDto $books): string {
                    return $books->getTitle();
                },
                'choice_value' => static function ($books) {
                    return isset($books) ? $books->getId() : null;
                },
                'constraints' =>
                    [
                        new Assert\NotNull(
                            [
                                'message' => 'id книги не может отсутствовать',
                            ]
                        ),
                        new Assert\Positive(['message' => 'id книги не может быть меньше нуля']),
                    ]
            ]
        )
            ->add('count', FormElement\IntegerType::class,
                [
                    'required' => true,
                    'label' => 'Количество книг',
                    'constraints' =>
                        [
                            new Assert\Type(['type' => 'int', 'message' => 'Количество книг должно быть числом']),
                            new Assert\NotNull(
                                [
                                    'message' => 'Количество книг не может отсутствовать',
                                ]
                            ),
                            new Assert\Positive(['message' => 'Количество книг не может быть меньше нуля']),
                        ]
                ]

            )
            ->add('participant_id', FormElement\ChoiceType::class,
                [
                    'required' => true,
                    'multiple' => false,
                    'label' => 'ФИО участника обмена',
                    'choices' => $this->participantsService->search(
                        new SearchParticipantsService\SearchParticipantsCriteria()
                    ),
                    'choice_label' => static function (SearchParticipantsService\ParticipantsDto $participants
                    ): string {
                        return $participants->getFio();
                    },
                    'choice_value' => static function ($participants) {
                        return isset($participants) ? $participants->getId() : null;
                    },
                    'constraints' =>
                        [
                            new Assert\NotNull(
                                [
                                    'message' => 'id участника обмена не может отсутствовать',
                                ]
                            ),
                            new Assert\Positive(['message' => 'id участника обмена не может быть меньше нуля']),
                        ]
                ]

            )
            ->add('submit', FormElement\SubmitType::class,
                [
                    'label' => 'Добавить',
                ]
            )->setMethod('POST');
        $builder->get('book_id')
            ->addModelTransformer(
                new CallbackTransformer(
                    static function ($bookId) {
                        return $bookId;
                    },
                            static function (SearchBooksService\BooksDto $bookDto) {
                                return $bookDto->getId();

                    },
                )
            );
        $builder->get('participant_id')
            ->addModelTransformer(
                new CallbackTransformer(
                    static function ($participantId) {
                        return $participantId;
                    },

                    static function (SearchParticipantsService\ParticipantsDto $participantDto){
                        return $participantDto->getId();
                    }


                )
            );


        parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
    }

}