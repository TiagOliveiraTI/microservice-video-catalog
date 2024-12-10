<?php

namespace Tests\Unit\Core\Domain\Validation;

use Core\Domain\Exceptions\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DomainValidation::class)]
class DomainValidationTest extends TestCase
{
    public function testNotNull(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Should not be empty or null');

        $value = '';

        DomainValidation::notNull($value);
    }
}
