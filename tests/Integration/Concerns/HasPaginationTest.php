<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasPaginationTest extends TestCase
{
    /** @test */
    public function it_can_reset_selecting_the_page(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('selectedPage', true)
            ->set('paginators.page', 2)
            ->assertSet('selectedPage', false);
    }

    /** @test */
    public function it_can_reset_the_page(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('paginators.page', 2)
            ->set('perPage', 30)
            ->assertSet('paginators.page', 1);
    }
}
