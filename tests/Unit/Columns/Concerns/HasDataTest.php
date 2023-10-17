<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns\Concerns;

use Illuminate\View\View;
use RamonRietdijk\LivewireTables\Columns\ViewColumn;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasDataTest extends TestCase
{
    /** @test */
    public function it_can_pass_data_as_an_array(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $column = ViewColumn::make('Actions', 'actions')->with(['key' => 'value']);

        /** @var View $view */
        $view = $column->resolveValue($user);

        $this->assertEquals('value', $view['key']);
    }

    /** @test */
    public function it_can_pass_data_as_a_key_value_pair(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $column = ViewColumn::make('Actions', 'actions')->with('key', 'value');

        /** @var View $view */
        $view = $column->resolveValue($user);

        $this->assertEquals('value', $view['key']);
    }
}
