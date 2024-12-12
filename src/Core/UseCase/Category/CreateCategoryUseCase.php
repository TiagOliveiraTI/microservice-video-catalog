<?php

declare(strict_types=1);

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;

class CreateCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepositoryInterface
    ) { }

    public function execute()
    {
        $category = new Category(
            name: 'teste'
        );

        $this->categoryRepositoryInterface->insert($category);
    }
}
