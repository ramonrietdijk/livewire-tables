<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Collections;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Collections\ColumnCollection;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

final class ColumnCollectionTest extends TestCase
{
    #[Test]
    public function it_can_get_searchable_columns(): void
    {
        $items = [
            Column::make('Column', 'column')->searchable(),
        ];

        $collection = ColumnCollection::make($items);

        $this->assertCount(1, $collection->searchable());
        $this->assertCount(0, $collection->searchable(false));
    }

    #[Test]
    public function it_can_get_computed_columns(): void
    {
        $items = [
            Column::make('Column', 'column')->computed(),
        ];

        $collection = ColumnCollection::make($items);

        $this->assertCount(1, $collection->computed());
        $this->assertCount(0, $collection->computed(false));
    }

    #[Test]
    public function it_can_get_all_column_names(): void
    {
        $items = [
            Column::make('Column', 'column'),
        ];

        $collection = ColumnCollection::make($items);

        $this->assertSame([
            'column',
        ], $collection->columns());
    }
}
