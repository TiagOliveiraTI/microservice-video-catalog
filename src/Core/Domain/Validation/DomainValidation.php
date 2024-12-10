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
    public static function notNull(string $value, string $exceptionMessage = null): void
    {
        if (empty($value)) {
            throw new EntityValidationException($exceptionMessage ?? 'Should not be empty or null');
        }
    }
}
