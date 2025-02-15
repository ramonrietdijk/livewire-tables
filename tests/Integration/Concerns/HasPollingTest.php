<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\PollingBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasPollingTest extends TestCase
{
    #[Test]
    public function it_can_poll(): void
    {
        Livewire::test(PollingBlogLivewireTable::class)
            ->set('polling', '10s')
            ->assertSeeHtml('wire:poll.10s');
    }

    #[Test]
    public function it_cant_poll_with_invalid_values(): void
    {
        Livewire::test(PollingBlogLivewireTable::class)
            ->set('polling', 'invalid')
            ->assertDontSeeHtml('wire:poll');
    }
}
