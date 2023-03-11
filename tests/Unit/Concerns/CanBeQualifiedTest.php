<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Concerns;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class CanBeQualifiedTest extends TestCase
{
    /** @test */
    public function it_can_be_qualified(): void
    {
        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = Column::make('Name', 'name');

        $this->assertEquals('users.name', $column->qualify($builder));
    }

    /** @test */
    public function it_can_be_qualified_with_an_alias(): void
    {
        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = Column::make('Name', 'author.company.name');

        $this->assertEquals('author_company.name', $column->qualify($builder));
    }

    /** @test */
    public function it_can_throw_exceptions(): void
    {
        $this->expectException(Exception::class);

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = Column::make('Column', null);

        $column->qualify($builder);
    }
}
