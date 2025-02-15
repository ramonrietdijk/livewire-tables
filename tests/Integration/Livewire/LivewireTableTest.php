<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Integration\Livewire;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\EmptyBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Company;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class LivewireTableTest extends TestCase
{
    #[Test]
    public function it_can_instantiate_an_empty_livewire_table(): void
    {
        Livewire::test(EmptyBlogLivewireTable::class)->assertSet('columns', []);
    }

    #[Test]
    public function it_can_do_advanced_querying(): void
    {
        /** @var User $johnDoe */
        $johnDoe = User::factory()->has(Company::factory())->create(['name' => 'John Doe']);

        Blog::factory()->count(20)->for($johnDoe, 'author')->published()->create();
        Blog::factory()->count(20)->for($johnDoe, 'author')->published(false)->create();

        /** @var User $janeDoe */
        $janeDoe = User::factory()->has(Company::factory())->create(['name' => 'Jane Doe']);

        Blog::factory()->count(20)->for($janeDoe, 'author')->published()->create();
        Blog::factory()->count(20)->for($janeDoe, 'author')->published(false)->create();

        /** @var User $richardDoe */
        $richardDoe = User::factory()->has(Company::factory())->create(['name' => 'Richard Doe']);

        Blog::factory()->count(5)->for($richardDoe, 'author')->published()->create(['title' => 'My Title']);

        Livewire::test(BlogLivewireTable::class)
            ->call('sort', 'author_name')
            ->set('filters.published', 1)
            ->set('columns', ['title', 'author_name'])
            ->call('selectPage', true)
            ->assertCount('selected', 15)
            ->assertSee('Selected 15 records')
            ->assertSeeTextInOrder(['Showing', '1', 'to', '15', 'of', '45', 'results'])
            ->set('perPage', 25)
            ->call('selectTable', true)
            ->assertCount('selected', 45)
            ->assertSee('Selected 45 records')
            ->assertSeeTextInOrder(['Showing', '1', 'to', '25', 'of', '45', 'results'])
            ->assertDontSeeText('My Title')
            ->call('selectTable', false)
            ->call('sort', 'author_name')
            ->assertSeeText('My Title')
            ->set('search.title', 'My Title')
            ->set('globalSearch', 'John Doe')
            ->assertSee('No results')
            ->set('search.title', '')
            ->set('filters.published', '')
            ->assertSeeTextInOrder(['Showing', '1', 'to', '25', 'of', '40', 'results']);
    }
}
