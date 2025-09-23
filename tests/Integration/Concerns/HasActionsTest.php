<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasActionsTest extends TestCase
{
    #[Test]
    public function it_can_execute_actions(): void
    {
        Blog::factory()->count(3)->create();

        Livewire::test(BlogLivewireTable::class)
            ->set('selected', ['1', '2', '3'])
            ->call('executeAction', 'publish')
            ->assertSet('selected', [])
            ->assertSuccessful();
    }

    #[Test]
    public function it_can_execute_actions_for_single_items(): void
    {
        Blog::factory()->count(3)->create();

        Livewire::test(BlogLivewireTable::class)
            ->call('executeItemAction', 'publish', '1')
            ->assertSuccessful();
    }

    #[Test]
    public function it_can_execute_standalone_actions(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->call('executeAction', 'publish_all')
            ->assertSuccessful();
    }
}
