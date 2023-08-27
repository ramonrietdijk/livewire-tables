<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasSortingTest extends TestCase
{
    /** @test */
    public function it_can_sort(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->assertSet('sortColumn', '')
            ->assertSet('sortDirection', '')
            ->call('sort', 'author_name')
            ->assertSet('sortColumn', 'author_name')
            ->assertSet('sortDirection', 'asc')
            ->call('sort', 'author_name')
            ->assertSet('sortColumn', 'author_name')
            ->assertSet('sortDirection', 'desc')
            ->call('sort', 'author_name')
            ->assertSet('sortColumn', '')
            ->assertSet('sortDirection', '');
    }
}
