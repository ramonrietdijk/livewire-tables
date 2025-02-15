<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Enums\TrashedMode;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\UserLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasSoftDeletesTest extends TestCase
{
    #[Test]
    public function it_can_see_without_trashed(): void
    {
        Blog::factory()->deleted()->create(['title' => 'Deleted']);
        Blog::factory()->create(['title' => 'Active']);

        Livewire::test(BlogLivewireTable::class)
            ->set('trashed', TrashedMode::WithoutTrashed->value)
            ->assertSee('Active')
            ->assertDontSee('Deleted');
    }

    #[Test]
    public function it_can_see_with_trashed(): void
    {
        Blog::factory()->deleted()->create(['title' => 'Deleted']);
        Blog::factory()->create(['title' => 'Active']);

        Livewire::test(BlogLivewireTable::class)
            ->set('trashed', TrashedMode::WithTrashed->value)
            ->assertSee('Active')
            ->assertSee('Deleted');
    }

    #[Test]
    public function it_can_see_only_trashed(): void
    {
        Blog::factory()->deleted()->create(['title' => 'Deleted']);
        Blog::factory()->create(['title' => 'Active']);

        Livewire::test(BlogLivewireTable::class)
            ->set('trashed', TrashedMode::OnlyTrashed->value)
            ->assertDontSee('Active')
            ->assertSee('Deleted');
    }

    #[Test]
    public function it_can_see_everything_without_the_soft_deletes_trait(): void
    {
        User::factory()->deleted()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Doe']);

        Livewire::test(UserLivewireTable::class)
            ->set('trashed', TrashedMode::WithoutTrashed->value)
            ->assertSee('John Doe')
            ->assertSee('Jane Doe');
    }
}
