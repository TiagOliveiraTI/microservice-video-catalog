<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethodsTrait;

class Category
{
    use MagicMethodsTrait;

    public function __construct(
        private string $id = '',
        private string $name = '',
        private string $description = '',
        private bool $isActive = true,
    ) {}

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
        $this->name = $name;
        $this->description = empty($description) ? $this->description : $description;
    }
}
