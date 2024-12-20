<?php

declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exceptions\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid as ValueObjectUuid;
use DateTime;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

#[CoversClass(Category::class)]
#[CoversClass(DomainValidation::class)]
#[CoversClass(ValueObjectUuid::class)]
class CategoryUnitTest extends TestCase
{
    public function testAttributes(): void
    {
        $category = new Category(
            name: 'New Cat',
            description: 'New desc',
            isActive: true,
        );

        $this->assertNotEmpty($category->id);
        $this->assertIsString($category->id());
        $this->assertEquals('New Cat', $category->name);
        $this->assertEquals('New desc', $category->description);
        $this->assertTrue($category->isActive);
    }

    public function testAttributesThrowsExceptionIfIdIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Core\Domain\ValueObject\Uuid does not allow the value <invalid_id>');

        $category = new Category(
            name: 'New Cat',
            id: 'invalid_id',
            description: 'New desc',
            isActive: true,
        );
        
    }

    public function testShouldThrowsExceptionIfCallAnInvalidProperty(): void
    {
        $this->expectException(Exception::class);

        $category = new Category(
            name: 'New Cat',
            description: 'New desc',
            isActive: true,
        );

        $this->assertEquals('New Cat', $category->any);
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
        $uuid = Uuid::uuid4()->toString();
        $category = new Category(
            id: $uuid,
            name: 'New Cat',
            description: 'New desc',
            isActive: true,
        );

        $description = str_repeat('a', 255);
        $category->update(
            name: 'new_name',
            description: $description,
        );

        $this->assertEquals($uuid, $category->id());
        $this->assertEquals('new_name', $category->name);
        $this->assertEquals($description, $category->description);

    }

    public function testShouldUpdateWIthMinDescriptionCharacters(): void
    {
        $uuid = Uuid::uuid4()->toString();
        $category = new Category(
            id: $uuid,
            name: 'New Cat',
            description: 'New desc',
            isActive: true,
        );

        $description = str_repeat('a', 3);
        $category->update(
            name: 'new_name',
            description: $description,
        );

        $this->assertEquals('new_name', $category->name);
        $this->assertEquals($description, $category->description);

    }

    public function testShouldThrowsExceptionIfTryUpdateWithAInvalidName(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('name cannot be empty');

        $uuid = Uuid::uuid4()->toString();

        $category = new Category(
            id: $uuid,
            name: 'New Cat',
            description: 'New desc',
            isActive: true,
        );

        $category->update(
            name: '',
        );
    }

    public function testShouldUpdateWithoutDescription(): void
    {
        $uuid = Uuid::uuid4()->toString();

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
        $uuid = Uuid::uuid4()->toString();

        $date = new DateTime();

        $category = new Category(
            id: $uuid,
            name: 'New Cat',
            isActive: true,
            createdAt: $date
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
        $this->expectExceptionMessage('name cannot be empty');
        
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
        
        new Category(name: 'Valid name', description: 'hi');
    }

    public function testShouldThrowsExceptionIfDescriptionIsLongerThan255Characters(): void
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('description cannot be greather than 255 characters');
        
        new Category(name: 'Valid name', description: str_repeat('a', 256));
    }

    public function testConstructorWithEmptyCreatedAt()
    {
        // Cria uma nova instância sem passar createdAt
        $category = new Category(name: 'New Cat',);

        // Verifica se createdAt é uma instância de DateTime
        $this->assertInstanceOf(DateTime::class, $category->createdAt);
    }

    public function testGetCreatedAt()
    {
        $date = new DateTime();
        $category = new Category(name: 'New Cat', createdAt: $date);

        $formattedDate = $category->createdAt();

        $this->assertEquals($date->format('Y-m-d H:i:s'), $formattedDate);
    }
}
