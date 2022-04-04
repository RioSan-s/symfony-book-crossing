<?php

namespace NonEfTech\BookCrossing\Controller;

class GetPointsController extends GetPointsCollectionController
{
    /**
     * Подготавливает данные для ответа
     *
     * @param array $foundPoints
     *
     * @return string[]
     */
    protected function buildResult(array $foundPoints): array
    {
        return 1 === count($foundPoints)
            ? $this->serializePoints(current($foundPoints))
            : ['status' => 'fail', 'message' => 'entity not found'];
    }

    /**
     * Определеяет http код
     *
     * @param array $foundPoints
     *
     * @return int
     */
    protected function buildHttpCode(array $foundPoints): int
    {
        return 0 === count($foundPoints) ? 404 : 200;
    }
}
