<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\SessionBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasSessionTest extends TestCase
{
    /** @test */
    public function it_can_store_sessions(): void
    {
        $sessionKey = SessionBlogLivewireTable::class.':configuration';

        Livewire::test(SessionBlogLivewireTable::class)
            ->assertSet('columns', ['title', 'published'])
            ->set('columns', ['title']);

        $value = session()->get($sessionKey);

        $this->assertEquals([
            'columns' => [
                'title',
            ],
        ], $value);
    }

    /** @test */
    public function it_only_stores_configured_properties_in_sessions(): void
    {
        $sessionKey = SessionBlogLivewireTable::class.':configuration';

        Livewire::test(SessionBlogLivewireTable::class)
            ->set('globalSearch', 'search');

        $this->assertFalse(session()->has($sessionKey));
    }

    /** @test */
    public function it_can_restore_sessions(): void
    {
        $sessionKey = SessionBlogLivewireTable::class.':configuration';

        session()->put($sessionKey, [
            'columns' => [
                'title',
            ],
        ]);

        Livewire::test(SessionBlogLivewireTable::class)
            ->assertSet('columns', ['title']);
    }
}
