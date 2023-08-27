<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\LivewireManager;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\DisabledQueryStringBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\QueryStringPrefixedBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasQueryStringTest extends TestCase
{
    /** @test */
    public function it_has_query_string_parameters(): void
    {
        /** @var LivewireManager $livewireManager */
        $livewireManager = app(LivewireManager::class);

        $livewireManager
            ->withQueryParams(['globalSearch' => '::global-search::'])
            ->test(BlogLivewireTable::class)
            ->assertSet('globalSearch', '::global-search::');
    }

    /** @test */
    public function it_has_prefixed_query_string_parameters(): void
    {
        /** @var LivewireManager $livewireManager */
        $livewireManager = app(LivewireManager::class);

        $livewireManager
            ->withQueryParams(['blog_globalSearch' => '::global-search::'])
            ->test(QueryStringPrefixedBlogLivewireTable::class)
            ->assertSet('globalSearch', '::global-search::');
    }

    /** @test */
    public function the_query_string_can_be_disabled(): void
    {
        /** @var LivewireManager $livewireManager */
        $livewireManager = app(LivewireManager::class);

        $livewireManager
            ->withQueryParams(['globalSearch' => '::global-search::'])
            ->test(DisabledQueryStringBlogLivewireTable::class)
            ->assertNotSet('globalSearch', '::global-search::');
    }
}
