<?php

namespace NonEfTech\BookCrossing\Controller;

class GetActOfTakingController extends GetActOfTakingCollectionController
{
    protected function buildResult(array $foundActOfTakings): array
    {
        return 1 === count($foundActOfTakings)
            ? $this->serializeActOfTaking(current($foundActOfTakings))
            : ['status' => 'fail', 'message' => 'entity not found'];
    }

    protected function buildHttpCode(array $foundActOfTakings): int
    {
        return 0 === count($foundActOfTakings) ? 404 : 200;
    }
}
