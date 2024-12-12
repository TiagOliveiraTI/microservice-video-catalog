<?php

namespace Tests\Unit\Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\CreateCategoryUseCase;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

#[CoversClass(CreateCategoryUseCase::class)]
class CategoryCreateUseCaseTest extends TestCase
{
    private MockInterface&CategoryRepositoryInterface $categoryRepositoryMock;
    private MockInterface&Category $categoryMock;

    protected function setUp(): void
    {
        $this->categoryRepositoryMock = Mockery::mock(
            stdClass::class, 
            CategoryRepositoryInterface::class
        );
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testCanCreateNewCategory(): void
    {
        $categoryId = Uuid::uuid4()->toString();
        $categoryName = 'name';

        $this->categoryMock = Mockery::mock(
            Category::class,
            [$categoryId, $categoryName]
        );

        $this->categoryRepositoryMock->shouldReceive('insert')->andReturn($this->categoryMock);

        $useCase = new CreateCategoryUseCase($this->categoryRepositoryMock);

        $useCase->execute();

        $this->assertTrue(true);
    }
}
