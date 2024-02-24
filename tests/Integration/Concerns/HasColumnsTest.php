<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\BlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasColumnsTest extends TestCase
{
    #[Test]
    public function it_can_select_all_columns(): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->call('selectAllColumns', true)
            ->assertSet('columns', [
                'thumbnail',
                'title',
                'category_title',
                'author_name',
                'author_company_name',
                'published',
                'created_at',
            ])
            ->call('selectAllColumns', false)
            ->assertSet('columns', []);
    }
}
