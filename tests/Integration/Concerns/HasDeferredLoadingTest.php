<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\DeferredLoadingBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasDeferredLoadingTest extends TestCase
{
    #[Test]
    public function it_can_defer_loading(): void
    {
        Livewire::test(DeferredLoadingBlogLivewireTable::class)
            ->assertSee('Fetching records...')
            ->call('init')
            ->assertDontSee('Fetching records...');
    }
}
