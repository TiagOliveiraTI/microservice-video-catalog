<?php

declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exceptions\EntityValidationException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Category::class)]
class CategoryUnitTest extends TestCase
{
    public function testAttributes(): void
    {
        $category = new Category(
            name: 'New Cat',
            description: 'New desc',
            isActive: true,
        );

        $this->assertEquals('New Cat', $category->name);
        $this->assertEquals('New desc', $category->description);
        $this->assertTrue($category->isActive);
    }

    public function testShouldActivate(): void
    {
        $category = new Category(
            name: 'New Cat',
            isActive: false
        );

        $this->assertFalse($category->isActive);
        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function testShouldDisable(): void
    {
        $category = new Category(
            name: 'New Cat'
        );

        $this->assertTrue($category->isActive);
        $category->disable();
        $this->assertFalse($category->isActive);
        
    }

    public function testShouldUpdate(): void
    {
        $uuid = 'uuid.value';
        $category = new Category(
            id: $uuid,
            name: 'New Cat',
            description: 'New desc',
            isActive: true,
        );

        $category->update(
            name: 'new_name',
            description: 'new_desc',
        );

        $this->assertEquals('new_name', $category->name);
        $this->assertEquals('new_desc', $category->description);

    }

    public function testShouldUpdateWithoutDescription(): void
    {
        $uuid = 'uuid.value';
        $category = new Category(
            id: $uuid,
            name: 'New Cat',
            description: 'New desc',
            isActive: true,
        );

        $category->update(
            name: 'new_name',
        );

        $this->assertEquals('new_name', $category->name);
        $this->assertEquals('New desc', $category->description);
    }

    public function testShouldUpdateWithDefaultDescription(): void
    {
        $uuid = 'uuid.value';
        $category = new Category(
            id: $uuid,
            name: 'New Cat',
            isActive: true,
        );

        $category->update(
            name: 'new_name',
        );

        $this->assertEquals('new_name', $category->name);
        $this->assertEquals('', $category->description);
    }

    public function testShouldThrowsExceptionIfNameIsEmpty(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('ame cannot be empty');
        
        $category = new Category(name: '');
    }

    public function testShouldThrowsExceptionIfNameHasTwoCharacters(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('name cannot be less than 3');
        
        $category = new Category(name: 'Hi');
    }

    public function testShouldThrowsExceptionIfDescriptionHasTwoCharacters(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('description cannot be less than 3');
        
        $category = new Category(name: 'Valid name', description: 'hi');
    }

    public function testShouldThrowsExceptionIfDescriptionIsLongerThan255Characters(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('description cannot be greather than 255');
        
        $category = new Category(name: 'Valid name', description: str_repeat('a', 256));
    }
}
