<?php

namespace Core\UseCase\Dto;

class CategoryCreateInputDto
{
    const ACTIVE_TRUE = true;
    public function __construct(
        public string $name,
        public string $description = '',
        public bool $isActive = self::ACTIVE_TRUE,
    ) {}
}
