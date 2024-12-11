<?php

declare(strict_types=1);

namespace Core\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as Ramseyuuid;
use Stringable;

class Uuid implements Stringable
{
    public function __construct(
        protected string $value
    ) {
        $this->ensureIsValid($this->value);
    }

    /**
     * @return self
     */
    public static function random(): self
    {
        return new self(Ramseyuuid::uuid4()->toString());
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @param string $id
     * @throws InvalidArgumentException
     * @return void
     */
    private function ensureIsValid(string $id): void
    {
        if( ! Ramseyuuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('%s does not allow the value <%s>', static::class, $id));
        }
    }
}
