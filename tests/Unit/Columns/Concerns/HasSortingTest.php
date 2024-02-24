<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Enums\Direction;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasSortingTest extends TestCase
{
    #[Test]
    public function it_can_be_sortable(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertFalse($column->isSortable());
        $this->assertNull($column->sortCallback());

        $column->sortable();

        $this->assertTrue($column->isSortable());
        $this->assertNull($column->sortCallback());
    }

    #[Test]
    public function it_can_be_sortable_with_a_callback(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertFalse($column->isSortable());
        $this->assertNull($column->sortCallback());

        $column->sortable(function (Builder $builder, Direction $direction): void {
            //
        });

        $this->assertTrue($column->isSortable());
        $this->assertNotNull($column->sortCallback());
    }

    #[Test]
    public function it_can_sort(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = Column::make('Name', 'name');
        $column->sort($builder, Direction::Ascending);

        /** @var User $user */
        $user = $builder->first();

        $this->assertEquals('Jane Doe', $user->name);
    }

    #[Test]
    public function it_can_apply_sorting(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = Column::make('Name', 'name');
        $column->applySorting($builder, Direction::Ascending);

        /** @var User $user */
        $user = $builder->first();

        $this->assertEquals('Jane Doe', $user->name);
    }

    #[Test]
    public function it_wont_apply_sorting_to_computed_columns(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = Column::make('Name', 'name')->computed();
        $column->applySorting($builder, Direction::Ascending);

        /** @var User $user */
        $user = $builder->first();

        $this->assertEquals('John Doe', $user->name);
    }

    #[Test]
    public function it_can_apply_sorting_with_a_callback(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = Column::make('Name', 'name')
            ->sortable(function (Builder $builder, Direction $direction): void {
                $builder->orderBy($builder->qualifyColumn('id'), $direction->value);
            });

        $column->applySorting($builder, Direction::Ascending);

        /** @var User $user */
        $user = $builder->first();

        $this->assertEquals('John Doe', $user->name);
    }
}
