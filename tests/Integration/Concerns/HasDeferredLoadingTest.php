<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Http\Livewire\DeferredLoadingBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasDeferredLoadingTest extends TestCase
{
    /** @test */
    public function it_can_defer_loading(): void
    {
        Livewire::test(DeferredLoadingBlogLivewireTable::class)
            ->assertSee('Fetching records...')
            ->call('init')
            ->assertDontSee('Fetching records...');
    }
}
