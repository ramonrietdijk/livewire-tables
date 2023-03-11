<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns\Concerns;

use RamonRietdijk\LivewireTables\Columns\DateColumn;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasFormatTest extends TestCase
{
    /** @test */
    public function it_can_have_a_format(): void
    {
        $column = DateColumn::make('Created At', 'created_at');

        $this->assertNull($column->getFormat());

        $column->format('Y-m-d');

        $this->assertEquals('Y-m-d', $column->getFormat());
    }
}
