<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Tests\Fakes\Livewire\ReorderingBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasReorderingTest extends TestCase
{
    #[Test]
    public function it_can_reset_the_selection(): void
    {
        Blog::factory()->count(3)->create();

        Livewire::test(ReorderingBlogLivewireTable::class)
            ->call('selectPage', true)
            ->assertNotSet('selected', [])
            ->set('reordering', true)
            ->assertSet('selectedPage', false)
            ->assertSet('selected', []);
    }

    /**
     * @param  array<int, string>  $result
     */
    #[Test]
    #[DataProvider('cases')]
    public function it_can_reorder_items(string $from, string $to, bool $above, array $result): void
    {
        Blog::factory()->createMany([
            ['order' => 1, 'title' => 'Banana'],
            ['order' => 2, 'title' => 'Apple'],
            ['order' => 3, 'title' => 'Pear'],
            ['order' => 4, 'title' => 'Mango'],
            ['order' => 5, 'title' => 'Strawberry'],
        ]);

        Livewire::test(ReorderingBlogLivewireTable::class)
            ->set('reordering', true)
            ->call('reorderItem', $from, $to, $above)
            ->assertSeeTextInOrder($result);
    }

    /** @return array<string, mixed> */
    public static function cases(): array
    {
        return [
            'From 2 to 4, below the row' => [
                'from' => '2',
                'to' => '4',
                'above' => false,
                'result' => ['Banana', 'Pear', 'Mango', 'Apple', 'Strawberry'],
            ],
            'From 4 to 2, below the row' => [
                'from' => '4',
                'to' => '2',
                'above' => false,
                'result' => ['Banana', 'Apple', 'Mango', 'Pear', 'Strawberry'],
            ],
            'From 2 to 4, above the row' => [
                'from' => '2',
                'to' => '4',
                'above' => true,
                'result' => ['Banana', 'Pear', 'Apple', 'Mango', 'Strawberry'],
            ],
            'From 4 to 2, above the row' => [
                'from' => '4',
                'to' => '2',
                'above' => true,
                'result' => ['Banana', 'Mango', 'Apple', 'Pear', 'Strawberry'],
            ],
            'From 1 to 5, below the row' => [
                'from' => '1',
                'to' => '5',
                'above' => false,
                'result' => ['Apple', 'Pear', 'Mango', 'Strawberry', 'Banana'],
            ],
            'From 5 to 1, above the row' => [
                'from' => '5',
                'to' => '1',
                'above' => true,
                'result' => ['Strawberry', 'Banana', 'Apple', 'Pear', 'Mango'],
            ],
            'From 1 to 1, above the row, does not change the order' => [
                'from' => '1',
                'to' => '1',
                'above' => true,
                'result' => ['Banana', 'Apple', 'Pear', 'Mango', 'Strawberry'],
            ],
            'From 1 to 2, above the row, does not change the order' => [
                'from' => '1',
                'to' => '2',
                'above' => true,
                'result' => ['Banana', 'Apple', 'Pear', 'Mango', 'Strawberry'],
            ],
        ];
    }
}
