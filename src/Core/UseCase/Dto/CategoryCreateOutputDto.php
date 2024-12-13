<?php

namespace Core\UseCase\Dto;

class CategoryCreateOutputDto
{
    const ACTIVE_TRUE = true;

    public function __construct(
        public string $id,
        public string $name,
        public string $description = '',
        public bool $is_active = self::ACTIVE_TRUE,
    ) {}
}
