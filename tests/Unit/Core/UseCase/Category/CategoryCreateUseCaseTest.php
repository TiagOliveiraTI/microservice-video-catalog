<?php

namespace Tests\Unit\Core\UseCase\Category;

use Mockery;
use stdClass;
use Ramsey\Uuid\Uuid;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Core\Domain\Entity\Category;
use Core\Domain\Validation\DomainValidation;
use Core\UseCase\Dto\CategoryCreateInputDto;
use Core\UseCase\Dto\CategoryCreateOutputDto;
use PHPUnit\Framework\Attributes\CoversClass;
use Core\Domain\Entity\Traits\MagicMethodsTrait;
use Core\UseCase\Category\CategoryCreateUseCase;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\ValueObject\Uuid as ValueObjectUuid;

#[CoversClass(Category::class)]
#[CoversClass(DomainValidation::class)]
#[CoversClass(ValueObjectUuid::class)]
#[CoversClass(CategoryCreateInputDto::class)]
#[CoversClass(CategoryCreateOutputDto::class)]
#[CoversClass(CategoryCreateUseCase::class)]
class CategoryCreateUseCaseTest extends TestCase
{
    private MockInterface&CategoryRepositoryInterface $categoryRepositoryMock;
    private MockInterface&Category $categoryMock;
    private MockInterface&CategoryCreateInputDto $categoryCreateInputDtoMock;

    protected function setUp(): void
    {
        $this->categoryRepositoryMock = Mockery::mock(
            stdClass::class, 
            CategoryRepositoryInterface::class
        );

        $this->categoryCreateInputDtoMock = Mockery::mock(
            stdClass::class, 
            CategoryCreateInputDto::class
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

        $this->categoryCreateInputDtoMock = Mockery::mock(
            CategoryCreateInputDto::class,
            [$categoryId, $categoryName]
        );

        $this->categoryMock->shouldReceive('id')->andReturn($categoryId);

        $this->categoryRepositoryMock->shouldReceive('insert')->andReturn($this->categoryMock);

        $useCase = new CategoryCreateUseCase($this->categoryRepositoryMock);

        $response = $useCase->execute($this->categoryCreateInputDtoMock);

        $this->assertInstanceOf(CategoryCreateOutputDto::class, $response);
        $this->assertSame($response->id, $categoryId);
        $this->assertSame($response->name, $categoryName);

        // Spy
        /**
         * @var MockInterface&CategoryRepositoryInterface 
         */
        $mockRepoSpy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $mockRepoSpy
            ->shouldReceive('insert')
            ->andReturn($this->categoryMock);

        $useCase = new CategoryCreateUseCase($mockRepoSpy);
        $response = $useCase->execute($this->categoryCreateInputDtoMock);

        $mockRepoSpy->shouldHaveReceived('insert');
    }
}
