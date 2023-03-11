<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Concerns;

use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasMetadataTest extends TestCase
{
    /** @test */
    public function it_can_interact_with_metadata(): void
    {
        $column = Column::make('Label', 'code')->setMeta('key', 'value');

        $this->assertEquals('value', $column->getMeta('key'));
    }
}
