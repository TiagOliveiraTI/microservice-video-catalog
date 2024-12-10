<?php

namespace Core\Domain\Validation;

use Core\Domain\Exceptions\EntityValidationException;

class DomainValidation
{
    /**
     * @param string $value
     * @param string|null $exceptionMessage
     * 
     * @throws EntityValidationException
     * 
     * @return void
     */
    public static function notNull(string $value, string $exceptionMessage = null): bool
    {
        if (empty($value)) {
            throw new EntityValidationException($exceptionMessage ?? 'Should not be empty or null');
        }

        return true;
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
    public static function strMaxLength(string $value, int $maxLength = 255, string $exceptionMessage = null): void
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
    public static function strMinLength(string $value, int $minLength = 10, string $exceptionMessage = null): void
    {
        if (! empty($value) && strlen($value) < $minLength) {
            throw new EntityValidationException($exceptionMessage ?? "Should not be less than $minLength characters");
        }
    }
}
