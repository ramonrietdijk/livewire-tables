<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\EmptyBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasSelectionTest extends TestCase
{
    #[Test]
    public function it_can_clear_the_selection(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('selectedPage', true)
            ->set('selected', ['1', '2', '3'])
            ->call('clearSelection')
            ->assertSet('selectedPage', false)
            ->assertSet('selected', []);
    }

    #[Test]
    public function it_can_select_a_single_item(): void
    {
        Blog::factory()->count(3)->create();

        Livewire::test(BlogLivewireTable::class)
            ->set('selected', ['1'])
            ->call('selectItem', '1')
            ->call('selectItem', '2')
            ->call('selectItem', '3')
            ->assertSet('selected', ['2', '3']);
    }

    #[Test]
    public function it_cant_select_a_single_item_when_no_actions_are_available(): void
    {
        Blog::factory()->count(3)->create();

        Livewire::test(EmptyBlogLivewireTable::class)
            ->call('selectItem', '1')
            ->call('selectItem', '2')
            ->call('selectItem', '3')
            ->assertCount('selected', 0);
    }

    #[Test]
    public function it_can_select_the_page(): void
    {
        Blog::factory()->count(30)->create();

        Livewire::test(BlogLivewireTable::class)
            ->set('selected', ['1', '2', '3', '4', '5'])
            ->call('selectPage', true)
            ->assertCount('selected', 15)
            ->call('selectPage', false)
            ->assertCount('selected', 0);
    }

    #[Test]
    public function it_cant_select_the_page_when_no_actions_are_available(): void
    {
        Blog::factory()->count(30)->create();

        Livewire::test(EmptyBlogLivewireTable::class)
            ->call('selectPage', true)
            ->assertCount('selected', 0);
    }

    #[Test]
    public function it_can_select_the_table(): void
    {
        Blog::factory()->count(30)->create();

        Livewire::test(BlogLivewireTable::class)
            ->set('selected', ['1', '2', '3', '4', '5'])
            ->call('selectTable', true)
            ->assertCount('selected', 30)
            ->call('selectTable', false)
            ->assertCount('selected', 0);
    }

    #[Test]
    public function it_cant_select_the_table_when_no_actions_are_available(): void
    {
        Blog::factory()->count(30)->create();

        Livewire::test(EmptyBlogLivewireTable::class)
            ->call('selectTable', true)
            ->assertCount('selected', 0);
    }
}
