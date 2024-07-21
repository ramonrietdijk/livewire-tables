<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\SessionBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasSessionTest extends TestCase
{
    #[Test]
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
            'columnOrder' => [
                'title',
                'published',
            ],
        ], $value);
    }

    #[Test]
    public function it_only_stores_configured_properties_in_sessions(): void
    {
        $sessionKey = SessionBlogLivewireTable::class.':configuration';

        Livewire::test(SessionBlogLivewireTable::class)
            ->set('globalSearch', 'search');

        $this->assertFalse(session()->has($sessionKey));
    }

    #[Test]
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
