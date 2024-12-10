<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethodsTrait;

class Category
{
    use MagicMethodsTrait;

    public function __construct(
        private string $id = '',
        private string $name,
        private string $description = '',
        private bool $isActive = true,
    ) {}
}
