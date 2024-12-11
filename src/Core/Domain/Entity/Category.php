<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethodsTrait;
use Core\Domain\Exceptions\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;

class Category
{
    use MagicMethodsTrait;

    const MINIMUM_NAME_LETTERS = 3;
    const MINIMUM_DESCRIPTION_LETTERS = 3;
    const MAXIMUM_DESCRIPTION_LETTERS = 255;

    public function __construct(
        private Uuid|string $id = '',
        private string $name = '',
        private string $description = '',
        private bool $isActive = true,
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::random();
        $this->validate();
    }

    /**
     * @return void
     */
    public function activate(): void
    {
        $this->isActive = true;
    }

    /**
     * @return void
     */
    public function disable(): void
    {
        $this->isActive = false;
    }

    /**
     * @param string $name
     * @param string $description
     * 
     * @return void
     */
    public function update(string $name, string $description = ''): void
    {
        $this->name = $name;
        $this->description = empty($description) ? $this->description : $description;

        $this->validate();
    }

    /**
     * @throws EntityValidationException
     * 
     * @return void
     */
    private function validate(): void
    {
        DomainValidation::notNull($this->name, "name cannot be empty");

        DomainValidation::strMinLength(
            $this->name, 
            self::MINIMUM_NAME_LETTERS, 
            "name cannot be less than " . self::MINIMUM_NAME_LETTERS
        );

        DomainValidation::strMinLength(
            $this->description, 
            self::MINIMUM_DESCRIPTION_LETTERS, 
            "description cannot be less than " . self::MINIMUM_DESCRIPTION_LETTERS
        );

        DomainValidation::strMaxLength(
            $this->description, 
            self::MAXIMUM_DESCRIPTION_LETTERS, 
            "description cannot be greather than " . self::MAXIMUM_DESCRIPTION_LETTERS . " characters"
        );
    }
}
