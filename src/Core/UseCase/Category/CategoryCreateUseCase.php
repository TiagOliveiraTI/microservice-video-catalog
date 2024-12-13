<?php

declare(strict_types=1);

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Dto\{CategoryCreateInputDto, CategoryCreateOutputDto};

class CategoryCreateUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepositoryInterface
    ) { }

    public function execute(CategoryCreateInputDto $inputDto): CategoryCreateOutputDto
    {
        $category = new Category(
            name: $inputDto->name,
            description: $inputDto->description,
            isActive: $inputDto->isActive,
        );

        $newCategory = $this->categoryRepositoryInterface->insert($category);

        return new CategoryCreateOutputDto(
            id: $newCategory->id(),
            name: $newCategory->name,
            description: $newCategory->description,
            is_active: $newCategory->isActive,
        );
    }
}
