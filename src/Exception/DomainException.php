<?php

namespace NonEfTech\BookCrossing\Exception;


/**
 * Исключение создается, если значение не соответствует определенной допустимой области данных.
 */
class DomainException extends \DomainException implements ExceptionInterface
{
}
