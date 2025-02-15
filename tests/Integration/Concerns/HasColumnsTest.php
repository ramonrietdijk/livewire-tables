<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
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

    /** @param  array<int, string> $order */
    #[Test]
    #[DataProvider('cases')]
    public function it_can_reorder_columns(string $from, string $to, bool $above, array $order): void
    {
        Livewire::test(BlogLivewireTable::class)
            ->call('reorderColumn', $from, $to, $above)
            ->assertSet('columnOrder', $order);
    }

    /** @return array<string, mixed> */
    public static function cases(): array
    {
        return [
            'From title to author_name, below the column' => [
                'from' => 'title',
                'to' => 'author_name',
                'above' => false,
                'order' => ['thumbnail', 'category_title', 'author_name', 'title', 'author_company_name', 'published', 'created_at'],
            ],
            'From author_name to title, below the column' => [
                'from' => 'author_name',
                'to' => 'title',
                'above' => false,
                'order' => ['thumbnail', 'title', 'author_name', 'category_title', 'author_company_name', 'published', 'created_at'],
            ],
            'From title to author_name, above the column' => [
                'from' => 'title',
                'to' => 'author_name',
                'above' => true,
                'order' => ['thumbnail', 'category_title', 'title', 'author_name', 'author_company_name', 'published', 'created_at'],
            ],
            'From author_name to title, above the column' => [
                'from' => 'author_name',
                'to' => 'title',
                'above' => true,
                'order' => ['thumbnail', 'author_name', 'title', 'category_title', 'author_company_name', 'published', 'created_at'],
            ],
            'From thumbnail to author_company_name, below the column' => [
                'from' => 'thumbnail',
                'to' => 'author_company_name',
                'above' => false,
                'order' => ['title', 'category_title', 'author_name', 'author_company_name', 'thumbnail', 'published', 'created_at'],
            ],
            'From author_company_name to thumbnail, above the column' => [
                'from' => 'author_company_name',
                'to' => 'thumbnail',
                'above' => true,
                'order' => ['author_company_name', 'thumbnail', 'title', 'category_title', 'author_name', 'published', 'created_at'],
            ],
            'From thumbnail to thumbnail, above the column, does not change the order' => [
                'from' => 'thumbnail',
                'to' => 'thumbnail',
                'above' => true,
                'order' => ['thumbnail', 'title', 'category_title', 'author_name', 'author_company_name', 'published', 'created_at'],
            ],
            'From thumbnail to title, above the column, does not change the order' => [
                'from' => 'thumbnail',
                'to' => 'title',
                'above' => true,
                'order' => ['thumbnail', 'title', 'category_title', 'author_name', 'author_company_name', 'published', 'created_at'],
            ],
        ];
    }
}
