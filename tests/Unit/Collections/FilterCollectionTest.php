<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Collections;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Collections\FilterCollection;
use RamonRietdijk\LivewireTables\Filters\SelectFilter;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class FilterCollectionTest extends TestCase
{
    #[Test]
    public function it_can_get_computed_filters(): void
    {
        $items = [
            SelectFilter::make('Column', 'column')->computed(),
        ];

        $collection = FilterCollection::make($items);

        $this->assertEquals(1, $collection->computed()->count());
        $this->assertEquals(0, $collection->computed(false)->count());
    }

    #[Test]
    public function it_can_get_all_column_names(): void
    {
        $items = [
            SelectFilter::make('Column', 'column'),
        ];

        $collection = FilterCollection::make($items);

        $this->assertEquals([
            'column',
        ], $collection->columns());
    }
}
