<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Collections;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Collections\ColumnCollection;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class ColumnCollectionTest extends TestCase
{
    #[Test]
    public function it_can_get_searchable_columns(): void
    {
        $items = [
            Column::make('Column', 'column')->searchable(),
        ];

        $collection = ColumnCollection::make($items);

        $this->assertEquals(1, $collection->searchable()->count());
        $this->assertEquals(0, $collection->searchable(false)->count());
    }

    #[Test]
    public function it_can_get_computed_columns(): void
    {
        $items = [
            Column::make('Column', 'column')->computed(),
        ];

        $collection = ColumnCollection::make($items);

        $this->assertEquals(1, $collection->computed()->count());
        $this->assertEquals(0, $collection->computed(false)->count());
    }

    #[Test]
    public function it_can_get_all_column_names(): void
    {
        $items = [
            Column::make('Column', 'column'),
        ];

        $collection = ColumnCollection::make($items);

        $this->assertEquals([
            'column',
        ], $collection->columns());
    }
}
