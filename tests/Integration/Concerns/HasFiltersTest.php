<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasFiltersTest extends TestCase
{
    #[Test]
    public function it_removes_empty_filters(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('filters.published', '')
            ->assertSet('filters', []);
    }

    #[Test]
    public function it_can_clear_filters(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('filters.published', 1)
            ->call('clearFilters')
            ->assertSet('filters', []);
    }
}
