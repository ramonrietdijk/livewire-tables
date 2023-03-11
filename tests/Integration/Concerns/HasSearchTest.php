<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Http\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasSearchTest extends TestCase
{
    /** @test */
    public function it_can_reset_the_page_when_searching_globally(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('page', 2)
            ->set('globalSearch', 'search')
            ->assertSet('page', 1);
    }

    /** @test */
    public function it_can_reset_the_page_when_searching_columns(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('page', 2)
            ->set('search.author_name', 'search')
            ->assertSet('page', 1);
    }

    /** @test */
    public function it_can_remove_empty_searches(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('search.author_name', 'search')
            ->assertSet('search', ['author_name' => 'search'])
            ->set('search.author_name', '')
            ->assertSet('search', []);
    }
}
