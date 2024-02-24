<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\SelectColumn;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class SelectColumnTest extends TestCase
{
    #[Test]
    public function it_can_search(): void
    {
        User::factory()->create(['name' => 'Alex']);
        User::factory()->create(['name' => 'Alexander']);

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $column = SelectColumn::make('Name', 'name');
        $column->search($builder, 'Alex');

        $this->assertEquals(1, $builder->count());
    }
}
