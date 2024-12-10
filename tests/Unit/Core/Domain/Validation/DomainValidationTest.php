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

    public function testNotNullWithCustomExceptionMessage(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('any message exception message');

        $value = '';

        DomainValidation::notNull($value, 'any message exception message');
    }

    public function testStrMaxLength(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Should not be greather than 4 characters');

        $value = 'Teste';

        DomainValidation::strMaxLength($value, 4);
    }

    public function testStrMinLength(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Should not be less than 10 characters');

        $value = 'Teste';

        DomainValidation::strMinLength($value);
    }

    public function testStrMinLengthWithAValue(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Should not be less than 3 characters');

        $value = 'hi';

        DomainValidation::strMinLength($value, 3);
    }
}
