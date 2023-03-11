<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Http\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasPaginationTest extends TestCase
{
    /** @test */
    public function it_can_reset_selecting_the_page(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('selectPage', true)
            ->set('page', 2)
            ->assertSet('selectPage', false);
    }

    /** @test */
    public function it_can_reset_the_page(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('page', 2)
            ->set('perPage', 30)
            ->assertSet('page', 1);
    }
}
