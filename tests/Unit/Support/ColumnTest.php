<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Support;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Support\Column;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class ColumnTest extends TestCase
{
    #[Test]
    public function it_can_get_the_column(): void
    {
        $column = Column::make('author.company.name');

        $this->assertEquals('author.company.name', $column->column()->toString());
    }

    #[Test]
    public function it_can_get_the_name(): void
    {
        $column = Column::make('author.company.name');

        $this->assertEquals('name', $column->name());
    }

    #[Test]
    public function it_can_get_determine_if_a_relation_is_available(): void
    {
        $column = Column::make('author.company.name');

        $this->assertTrue($column->hasRelation());

        $column = Column::make('title');

        $this->assertFalse($column->hasRelation());
    }

    #[Test]
    public function it_can_get_the_relation(): void
    {
        $column = Column::make('author.company.name');

        $this->assertEquals('author.company', $column->relation());
    }

    #[Test]
    public function it_can_get_the_relation_alias(): void
    {
        $column = Column::make('author.company.name');

        $this->assertEquals('author_company', $column->alias());
    }

    #[Test]
    public function it_can_qualify_the_column(): void
    {
        $builder = Blog::query();

        $column = Column::make('title');

        $this->assertEquals('blogs.title', $column->qualify($builder));
    }

    #[Test]
    public function it_can_qualify_the_column_with_relations(): void
    {
        $builder = Blog::query();

        $column = Column::make('author.company.name');

        $this->assertEquals('author_company.name', $column->qualify($builder));
    }

    #[Test]
    public function it_can_get_the_segments(): void
    {
        $column = Column::make('author.company.name');

        $this->assertEquals([
            'author',
            'company',
            'name',
        ], $column->segments());
    }
}
