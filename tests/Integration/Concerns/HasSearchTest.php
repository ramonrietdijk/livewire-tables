<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasSearchTest extends TestCase
{
    #[Test]
    public function it_can_reset_the_page_when_searching_globally(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('paginators.page', 2)
            ->set('globalSearch', 'search')
            ->assertSet('paginators.page', 1);
    }

    #[Test]
    public function it_can_reset_the_page_when_searching_columns(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('paginators.page', 2)
            ->set('search.author_name', 'search')
            ->assertSet('paginators.page', 1);
    }

    #[Test]
    public function it_can_remove_empty_searches(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('search.author_name', 'search')
            ->assertSet('search', ['author_name' => 'search'])
            ->set('search.author_name', '')
            ->assertSet('search', []);
    }
}
