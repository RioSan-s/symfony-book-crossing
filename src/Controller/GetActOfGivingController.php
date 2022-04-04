<?php

namespace NonEfTech\BookCrossing\Controller;

class GetActOfGivingController extends GetActOfGivingCollectionController
{
    protected function buildResult(array $foundActOfGivings): array
    {
        return 1 === count($foundActOfGivings)
            ? $this->serializeActOfGiving(current($foundActOfGivings))
            : ['status' => 'fail', 'message' => 'entity not found'];
    }

    protected function buildHttpCode(array $foundActOfGivings): int
    {
        return 0 === count($foundActOfGivings) ? 404 : 200;
    }
}
