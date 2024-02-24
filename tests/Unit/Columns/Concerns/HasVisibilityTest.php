<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasVisibilityTest extends TestCase
{
    #[Test]
    public function it_can_be_hidden(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertTrue($column->isVisible());

        $column->hide();

        $this->assertFalse($column->isVisible());
    }
}
