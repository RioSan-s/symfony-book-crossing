<?php

namespace NonEfTech\BookCrossing\Service\ArrivalNewActOfTakingService;

class ResultRegisteringActOfTakingDto
{
    /**
     * id акта обмена
     *
     * @var int
     */
    private int $id;

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
