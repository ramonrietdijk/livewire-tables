<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Http\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasSelectionTest extends TestCase
{
    /** @test */
    public function it_can_clear_the_selection(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->set('selectPage', true)
            ->set('selected', ['1', '2', '3'])
            ->call('clearSelection')
            ->assertSet('selectPage', false)
            ->assertSet('selected', []);
    }

    /** @test */
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

    /** @test */
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

    /** @test */
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
}
