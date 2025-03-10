<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\SelectColumn;
use RamonRietdijk\LivewireTables\Enums\SearchScope;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class SelectColumnTest extends TestCase
{
    #[Test]
    public function it_can_search_scoped_column(): void
    {
        User::factory()->create(['name' => 'Alex']);
        User::factory()->create(['name' => 'Alexander']);

        $builder = User::query();

        $column = SelectColumn::make('Name', 'name');
        $column->search($builder, SearchScope::Column, 'Alex');

        $this->assertEquals(1, $builder->count());
    }

    #[Test]
    public function it_can_search_scoped_global(): void
    {
        User::factory()->create(['name' => 'Alex']);
        User::factory()->create(['name' => 'Alexander']);

        $builder = User::query();

        $column = SelectColumn::make('Name', 'name');
        $column->search($builder, SearchScope::Global, 'Alex');

        $this->assertEquals(2, $builder->count());
    }
}
