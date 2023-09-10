<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns;

use Illuminate\View\View;
use RamonRietdijk\LivewireTables\Columns\ViewColumn;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class ViewColumnTest extends TestCase
{
    /** @test */
    public function it_can_resolve_views(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $column = ViewColumn::make('Actions', 'actions');

        /** @var View $view */
        $view = $column->resolveValue($user);

        $data = $view->getData();
        $model = $data['model'] ?? null;

        $this->assertNotNull($model);
    }

    /** @test */
    public function it_can_resolve_views_via_a_callback(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $column = ViewColumn::make('Actions', fn (): string => 'actions');

        /** @var View $view */
        $view = $column->resolveValue($user);

        $data = $view->getData();
        $model = $data['model'] ?? null;

        $this->assertNotNull($model);
    }

    /** @test */
    public function it_can_resolve_null(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $column = ViewColumn::make('Actions');

        $view = $column->resolveValue($user);

        $this->assertNull($view);
    }
}
