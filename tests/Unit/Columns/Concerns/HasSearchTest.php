<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns\Concerns;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasSearchTest extends TestCase
{
    #[Test]
    public function it_can_be_searchable(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertFalse($column->isSearchable());
        $this->assertNull($column->searchCallback());

        $column->searchable();

        $this->assertTrue($column->isSearchable());
        $this->assertNull($column->searchCallback());
    }

    #[Test]
    public function it_can_be_searchable_with_a_callback(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertFalse($column->isSearchable());
        $this->assertNull($column->searchCallback());

        $column->searchable(function (Builder $builder, mixed $search): void {
            //
        });

        $this->assertTrue($column->isSearchable());
        $this->assertNotNull($column->searchCallback());
    }

    #[Test]
    public function it_can_search(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = Column::make('Name', 'name');
        $column->search($builder, 'John');

        $this->assertEquals(1, $builder->count());
    }

    #[Test]
    public function it_can_search_json_columns(): void
    {
        User::factory()->create(['name' => 'John Doe', 'preferences' => ['theme' => 'Light']]);
        User::factory()->create(['name' => 'Jane Doe', 'preferences' => ['theme' => 'Dark']]);

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = Column::make('Theme', 'preferences->theme');
        $column->search($builder, 'Dark');

        $this->assertEquals(1, $builder->count());
    }

    #[Test]
    public function it_can_apply_searching(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = Column::make('Name', 'name');
        $column->applySearch($builder, 'John');

        $this->assertEquals(1, $builder->count());
    }

    #[Test]
    public function it_wont_apply_searching_to_computed_columns(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = Column::make('Name', 'name')->computed();
        $column->applySearch($builder, 'John');

        $this->assertEquals(2, $builder->count());
    }

    #[Test]
    public function it_can_apply_searching_with_a_callback(): void
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = Column::make('Name', 'name')
            ->searchable(function (Builder $builder, mixed $search): void {
                $builder
                    ->where('name', 'LIKE', '%'.$search.'%')
                    ->where('name', 'NOT LIKE', '%Jane%');
            });

        $column->applySearch($builder, 'Doe');

        $this->assertEquals(1, $builder->count());
    }

    #[Test]
    public function it_can_render_the_search_section(): void
    {
        $column = Column::make('Column', 'column');

        /** @var View $view */
        $view = $column->renderSearch();

        $data = $view->getData();
        $column = $data['column'] ?? null;

        $this->assertNotNull($column);
    }
}
