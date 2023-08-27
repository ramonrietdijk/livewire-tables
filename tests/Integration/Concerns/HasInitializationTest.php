<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasInitializationTest extends TestCase
{
    /** @test */
    public function it_can_be_initialized(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->assertSet('initialized', false)
            ->call('init')
            ->assertSet('initialized', true);
    }
}
