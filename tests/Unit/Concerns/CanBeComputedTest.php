<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Concerns;

use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class CanBeComputedTest extends TestCase
{
    /** @test */
    public function it_can_be_computed(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertFalse($column->isComputed());

        $column->computed();

        $this->assertTrue($column->isComputed());
    }
}
