<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Filters\Concerns;

use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Filters\SelectFilter;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasFilterTest extends TestCase
{
    #[Test]
    public function it_can_have_a_filter_using_callback(): void
    {
        $filter = SelectFilter::make('Filter', 'column');

        $this->assertNull($filter->filterUsingCallback());

        $filter->filterUsing(function (Builder $builder, mixed $value): void {
            //
        });

        $this->assertNotNull($filter->filterUsingCallback());
    }

    #[Test]
    public function it_can_filter(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        $builder = User::query();

        $filter = SelectFilter::make('Name', 'name');
        $filter->filter($builder, 'John Doe');

        $this->assertEquals(1, $builder->count());
    }

    #[Test]
    public function it_can_filter_with_arrays(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);
        User::factory()->create(['name' => 'Richard Doe']);

        $builder = User::query();

        $filter = SelectFilter::make('Name', 'name')->multiple();
        $filter->filter($builder, ['John Doe', 'Jane Doe']);

        $this->assertEquals(2, $builder->count());
    }

    #[Test]
    public function it_can_filter_json_columns(): void
    {
        User::factory()->create(['name' => 'John Doe', 'preferences' => ['theme' => 'Light']]);
        User::factory()->create(['name' => 'Jane Doe', 'preferences' => ['theme' => 'Dark']]);

        $builder = User::query();

        $filter = SelectFilter::make('Theme', 'preferences->theme');
        $filter->filter($builder, 'Dark');

        $this->assertEquals(1, $builder->count());
    }

    #[Test]
    public function it_can_filter_json_columns_with_arrays(): void
    {
        User::factory()->create(['name' => 'John Doe', 'preferences' => ['theme' => 'Light']]);
        User::factory()->create(['name' => 'Jane Doe', 'preferences' => ['theme' => 'Dark']]);

        $builder = User::query();

        $filter = SelectFilter::make('Theme', 'preferences->theme');
        $filter->filter($builder, ['Light', 'Dark']);

        $this->assertEquals(2, $builder->count());
    }

    #[Test]
    public function it_can_apply_filtering(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        $builder = User::query();

        $filter = SelectFilter::make('Name', 'name');
        $filter->applyFilter($builder, 'John Doe');

        $this->assertEquals(1, $builder->count());
    }

    #[Test]
    public function it_wont_apply_filtering_to_computed_columns(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        $builder = User::query();

        $filter = SelectFilter::make('Name', 'name')->computed();
        $filter->applyFilter($builder, 'John Doe');

        $this->assertEquals(2, $builder->count());
    }

    #[Test]
    public function it_can_apply_filtering_with_a_callback(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        $builder = User::query();

        $filter = SelectFilter::make('Name', 'name')
            ->filterUsing(function (Builder $builder, mixed $value): void {
                if (is_string($value)) {
                    $builder
                        ->where('name', 'LIKE', '%'.$value.'%')
                        ->where('name', 'NOT LIKE', '%Jane%');
                }
            });

        $filter->applyFilter($builder, 'Doe');

        $this->assertEquals(1, $builder->count());
    }
}
