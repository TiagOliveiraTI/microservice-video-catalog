<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethodsTrait;
use Core\Domain\Exceptions\EntityValidationException;

class Category
{
    use MagicMethodsTrait;

    const MINIMUM_NAME_LETTERS = 3;
    const MINIMUM_DESCRIPTION_LETTERS = 3;
    const MAXIMUM_DESCRIPTION_LETTERS = 255;

    public function __construct(
        private string $id = '',
        private string $name = '',
        private string $description = '',
        private bool $isActive = true,
    ) {
        $this->validate();
    }

    public function activate(): void
    {
        $this->isActive = true;
    }

    public function disable(): void
    {
        $this->isActive = false;
    }

    public function update(string $name, string $description = ''): void
    {
        $this->validate();
        $this->name = $name;
        $this->description = empty($description) ? $this->description : $description;
    }

    /**
     * @throws EntityValidationException
     */
    public function validate(): void
    {
        if(empty($this->name)) {
            throw new EntityValidationException("name cannot be empty");
        }

        if( ! empty($this->name) && strlen($this->name) < self::MINIMUM_NAME_LETTERS) {
            throw new EntityValidationException("name cannot be less than " . self::MINIMUM_NAME_LETTERS);
        }

        if( ! empty($this->description) && strlen($this->description) < self::MINIMUM_DESCRIPTION_LETTERS) {
            throw new EntityValidationException("description cannot be less than " . self::MINIMUM_DESCRIPTION_LETTERS);
        }

        if( ! empty($this->description) && strlen($this->description) > self::MAXIMUM_DESCRIPTION_LETTERS) {
            throw new EntityValidationException("description cannot be greather than " . self::MAXIMUM_DESCRIPTION_LETTERS);
        }
    }
}
