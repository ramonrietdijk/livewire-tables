<?php

declare(strict_types=1);

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
            ->assertSet('initialized', false)
            ->call('init')
            ->assertSet('initialized', true);
    }
}
