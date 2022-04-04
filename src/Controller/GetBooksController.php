<?php

namespace NonEfTech\BookCrossing\Controller;

class GetBooksController extends GetBooksCollectionController
{
    protected function buildResult(array $foundOfBooks): array
    {
        return 1 === count($foundOfBooks)
            ? $this->serializeBooks(current($foundOfBooks))
            : ['status' => 'fail', 'message' => 'entity not found'];
    }

    protected function buildHttpCode(array $foundOfBooks): int
    {
        return 0 === count($foundOfBooks) ? 404 : 200;
    }
}
