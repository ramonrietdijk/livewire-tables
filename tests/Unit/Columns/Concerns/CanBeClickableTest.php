<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns\Concerns;

use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class CanBeClickableTest extends TestCase
{
    /** @test */
    public function it_can_be_clickable(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertTrue($column->isClickable());

        $column->clickable(false);

        $this->assertFalse($column->isClickable());
    }
}
