<?php

declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Entity;

use Core\Domain\Entity\Category;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Category::class)]
class CategoryUnitTest extends TestCase
{
    public function testAttributes(): void
    {
        $category = new Category(
            id: 'any',
            name: 'New Cat',
            description: 'New desc',
            isActive: true,
        );

        $this->assertEquals('New Cat', $category->name);
        $this->assertEquals('New desc', $category->description);
        $this->assertTrue($category->isActive);
    }
}
