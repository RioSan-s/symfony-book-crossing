<?php

namespace NonEfTech\BookCrossing\Exception;

/**
 * Исключение бросается если значениене не совпадает с набором заданных значений. Обычно происходит
 * когда функця, вызывает другую функцию и ожидает, что вохвращаемое значение определенного типа
 */
class UnexpectedValueException extends \UnexpectedValueException implements ExceptionInterface
{
}
