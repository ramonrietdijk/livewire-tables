<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasInitializationTest extends TestCase
{
    #[Test]
    public function it_can_be_initialized(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->assertSet('initialized', false)
            ->call('init')
            ->assertSet('initialized', true);
    }
}
