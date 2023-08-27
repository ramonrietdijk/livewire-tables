<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasFiltersTest extends TestCase
{
    /** @test */
    public function it_removes_empty_filters(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('filters.published', '')
            ->assertSet('filters', []);
    }

    /** @test */
    public function it_can_clear_filters(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('filters.published', 1)
            ->call('clearFilters')
            ->assertSet('filters', []);
    }
}
