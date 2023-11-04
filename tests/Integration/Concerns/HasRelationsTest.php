<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\RelationBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Category;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Company;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Tag;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasRelationsTest extends TestCase
{
    /** @test */
    public function it_can_load_different_types_of_relations(): void
    {
        Company::factory()
            ->has(
                User::factory()
                    ->state(['name' => 'John Doe'])
                    ->has(
                        Blog::factory()
                            ->state(['title' => 'My Blog'])
                            ->for(
                                Category::factory()->state(['title' => 'My Category'])
                            )
                            ->has(
                                Tag::factory()->state(['name' => 'Tag 1'])
                            )
                            ->has(
                                Tag::factory()->state(['name' => 'Tag 2'])
                            )
                    ),
                'employees'
            )
            ->has(
                User::factory()
                    ->state(['name' => 'Jane Doe'])
                    ->has(
                        Blog::factory()
                            ->state(['title' => 'My Second Blog'])
                            ->for(
                                Category::factory()->state(['title' => 'My Second Category'])
                            )
                            ->has(
                                Tag::factory()->state(['name' => 'Tag 3'])
                            )
                    ),
                'employees'
            )
            ->create([
                'name' => 'My Company',
            ]);

        Livewire::test(RelationBlogLivewireTable::class)
            ->assertSee('My Blog')
            ->assertSee('My Second Blog')
            ->assertSee('My Category')
            ->assertSee('My Second Category')
            ->assertSee('JOHN DOE')
            ->assertSee('JANE DOE')
            ->assertSee('My Company')
            ->assertSee('John Doe, Jane Doe')
            ->assertSee('Tag 1, Tag 2')
            ->assertSee('Tag 3')
            ->set('search.tags_name', 'Tag 3')
            ->assertSee('My Second Blog')
            ->assertDontSee('My Blog')
            ->assertSee('My Second Category')
            ->assertDontSee('My Category')
            ->assertSee('Tag 3')
            ->assertDontSee('Tag 1, Tag 2')
            ->assertSee('JANE DOE')
            ->assertDontSee('JOHN DOE');
    }
}
