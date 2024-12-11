<?php

declare(strict_types=1);

namespace Core\Domain\Repository;

use Core\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
    /**
     * @param Category $category
     * 
     * @return Category
     */
    public function insert(Category $category): Category;

    /**
     * @param string $filter
     * @param string $order
     * 
     * @return array<Category>
     */
    public function findAll(string $filter = '', $order = 'DESC'): array;

    /**
     * @param string $id
     * 
     * @return array
     */
    public function findById(string $id): array;

    /**
     * @param string $filter
     * @param string $order
     * @param int $page
     * @param int $totalPage
     * 
     * @return array<Category>
     */
    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15 ): array;

    /**
     * @param Category $category
     * 
     * @return Category
     */
    public function update(Category $category): Category;

    /**
     * @param string $id
     * 
     * @return bool
     */
    public function delete(string $id): bool;

    /**
     * @param string $id
     * 
     * @return Category
     */
    public function toCategory(object $data): Category;
}
