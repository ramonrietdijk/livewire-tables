<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Support\Column;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class ColumnTest extends TestCase
{
    /** @test */
    public function it_can_get_the_column(): void
    {
        $column = Column::make('author.company.name');

        $this->assertEquals('author.company.name', $column->column()->toString());
    }

    /** @test */
    public function it_can_get_the_name(): void
    {
        $column = Column::make('author.company.name');

        $this->assertEquals('name', $column->name());
    }

    /** @test */
    public function it_can_get_determine_if_a_relation_is_available(): void
    {
        $column = Column::make('author.company.name');

        $this->assertTrue($column->hasRelation());

        $column = Column::make('title');

        $this->assertFalse($column->hasRelation());
    }

    /** @test */
    public function it_can_get_the_relation(): void
    {
        $column = Column::make('author.company.name');

        $this->assertEquals('author.company', $column->relation());
    }

    /** @test */
    public function it_can_get_the_relation_alias(): void
    {
        $column = Column::make('author.company.name');

        $this->assertEquals('author_company', $column->alias());
    }

    /** @test */
    public function it_can_qualify_the_column(): void
    {
        /** @var Builder<Model> $builder */
        $builder = Blog::query();

        $column = Column::make('title');

        $this->assertEquals('blogs.title', $column->qualify($builder));
    }

    /** @test */
    public function it_can_qualify_the_column_with_relations(): void
    {
        /** @var Builder<Model> $builder */
        $builder = Blog::query();

        $column = Column::make('author.company.name');

        $this->assertEquals('author_company.name', $column->qualify($builder));
    }

    /** @test */
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
