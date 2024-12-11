<?php

namespace Core\Domain\Validation;

use Core\Domain\Exceptions\EntityValidationException;

class DomainValidation
{
    const MINIMUM_NAME_LETTERS = 3;
    const MINIMUM_LETTERS = 10;
    const MAXIMUM_LETTERS = 255;

    /**
     * @param string $value
     * @param string|null $exceptionMessage
     * 
     * @throws EntityValidationException
     * 
     * @return void
     */
    public static function notNull(string $value, string $exceptionMessage = null): void
    {
        if (empty($value)) {
            throw new EntityValidationException($exceptionMessage ?? 'Should not be empty or null');
        }
    }

    /**
     * @param string $value
     * @param int $maxLength
     * @param string|null $message
     * 
     * @throws EntityValidationException
     * 
     * @return void
     */
    public static function strMaxLength(string $value, int $maxLength = self::MAXIMUM_LETTERS, string $exceptionMessage = null): void
    {
        if (! empty($value) && strlen($value) > $maxLength) {
            throw new EntityValidationException($exceptionMessage ?? "Should not be greather than $maxLength characters");
        }
    }

    /**
     * @param string $value
     * @param int $minLength
     * @param string|null $message
     * 
     * @throws EntityValidationException
     * 
     * @return void
     */
    public static function strMinLength(string $value, int $minLength = self::MINIMUM_LETTERS, string $exceptionMessage = null): void
    {
        if (! empty($value) && strlen($value) < $minLength) {
            throw new EntityValidationException($exceptionMessage ?? "Should not be less than $minLength characters");
        }
    }
}
