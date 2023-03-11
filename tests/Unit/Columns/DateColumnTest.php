<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns;

use RamonRietdijk\LivewireTables\Columns\DateColumn;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class DateColumnTest extends TestCase
{
    /** @test */
    public function it_can_resolve_nullable_values(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $column = DateColumn::make('Created At', 'null');

        $value = $column->resolveValue($user);

        $this->assertNull($value);
    }

    /** @test */
    public function it_can_resolve_values_with_a_format(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['created_at' => '2023-02-25 12:00:00']);

        $column = DateColumn::make('Created At', 'created_at')->format('d-m-Y');

        $value = $column->resolveValue($user);

        $this->assertEquals($value, '25-02-2023');
    }

    /** @test */
    public function it_can_resolve_values_without_a_format(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['created_at' => '2023-02-25 12:00:00']);

        $column = DateColumn::make('Created At', 'created_at');

        $value = $column->resolveValue($user);

        $this->assertEquals($value, '2023-02-25 12:00:00');
    }

    /** @test */
    public function display_using_always_takes_priority(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['created_at' => '2023-02-25 12:00:00']);

        $column = DateColumn::make('Created At', 'created_at')
            ->format('d-m-Y')
            ->displayUsing(fn (): string => 'Display Using');

        $value = $column->resolveValue($user);

        $this->assertEquals($value, 'Display Using');
    }
}
