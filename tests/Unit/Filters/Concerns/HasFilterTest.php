<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Filters\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Filters\SelectFilter;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasFilterTest extends TestCase
{
    /** @test */
    public function it_can_have_a_filter_using_callback(): void
    {
        $filter = SelectFilter::make('Filter', 'column');

        $this->assertNull($filter->filterUsingCallback());

        $filter->filterUsing(function (Builder $builder, mixed $value): void {
            //
        });

        $this->assertNotNull($filter->filterUsingCallback());
    }

    /** @test */
    public function it_can_filter(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        $filter = SelectFilter::make('Name', 'name');

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $filter->filter($builder, 'John Doe');

        $this->assertEquals(1, $builder->count());
    }

    /** @test */
    public function it_can_filter_with_arrays(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);
        User::factory()->create(['name' => 'Richard Doe']);

        $filter = SelectFilter::make('Name', 'name')->multiple();

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $filter->filter($builder, ['John Doe', 'Jane Doe']);

        $this->assertEquals(2, $builder->count());
    }

    /** @test */
    public function it_can_apply_filtering(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        $filter = SelectFilter::make('Name', 'name');

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $filter->applyFilter($builder, 'John Doe');

        $this->assertEquals(1, $builder->count());
    }

    /** @test */
    public function it_wont_apply_filtering_to_computed_columns(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        $filter = SelectFilter::make('Name', 'name')->computed();

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $filter->applyFilter($builder, 'John Doe');

        $this->assertEquals(2, $builder->count());
    }

    /** @test */
    public function it_can_apply_filtering_with_a_callback(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        $filter = SelectFilter::make('Name', 'name')
            ->filterUsing(function (Builder $builder, mixed $value): void {
                $builder
                    ->where('name', 'LIKE', '%'.$value.'%')
                    ->where('name', 'NOT LIKE', '%Jane%');
            });

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $filter->applyFilter($builder, 'Doe');

        $this->assertEquals(1, $builder->count());
    }
}
