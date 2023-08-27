<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasActionsTest extends TestCase
{
    /** @test */
    public function it_can_execute_actions(): void
    {
        Blog::factory()->count(3)->create();

        Livewire::test(BlogLivewireTable::class)
            ->set('selected', ['1', '2', '3'])
            ->call('executeAction', 'publish')
            ->assertDispatched('refreshLivewireTable')
            ->assertSet('selected', []);
    }

    /** @test */
    public function it_can_execute_standalone_actions(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->call('executeAction', 'publish_all')
            ->assertDispatched('refreshLivewireTable');
    }
}
