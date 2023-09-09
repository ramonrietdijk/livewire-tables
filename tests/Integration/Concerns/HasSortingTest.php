<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\ReorderingBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasSortingTest extends TestCase
{
    /** @test */
    public function it_can_sort(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->assertSet('sortColumn', '')
            ->assertSet('sortDirection', '')
            ->call('sort', 'author_name')
            ->assertSet('sortColumn', 'author_name')
            ->assertSet('sortDirection', 'asc')
            ->call('sort', 'author_name')
            ->assertSet('sortColumn', 'author_name')
            ->assertSet('sortDirection', 'desc')
            ->call('sort', 'author_name')
            ->assertSet('sortColumn', '')
            ->assertSet('sortDirection', '');
    }

    /** @test */
    public function it_can_sort_by_the_reordering_column_if_no_sorting_is_set(): void
    {
        Blog::factory()->createMany([
            ['order' => 1, 'title' => 'Banana'],
            ['order' => 3, 'title' => 'Apple'],
            ['order' => 2, 'title' => 'Pear'],
        ]);

        Livewire::test(ReorderingBlogLivewireTable::class)
            ->assertSet('reordering', false)
            ->assertSeeTextInOrder(['Banana', 'Pear', 'Apple'])
            ->call('sort', 'title')
            ->assertSeeTextInOrder(['Apple', 'Banana', 'Pear']);
    }

    /** @test */
    public function it_can_ignore_the_set_sorting_when_reordering(): void
    {
        Blog::factory()->createMany([
            ['order' => 1, 'title' => 'Banana'],
            ['order' => 3, 'title' => 'Apple'],
            ['order' => 2, 'title' => 'Pear'],
        ]);

        Livewire::test(ReorderingBlogLivewireTable::class)
            ->assertSet('reordering', false)
            ->call('sort', 'title')
            ->assertSeeTextInOrder(['Apple', 'Banana', 'Pear'])
            ->set('reordering', true)
            ->assertSeeTextInOrder(['Banana', 'Pear', 'Apple']);
    }
}
