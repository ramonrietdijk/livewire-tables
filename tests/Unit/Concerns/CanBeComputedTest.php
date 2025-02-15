<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class CanBeComputedTest extends TestCase
{
    #[Test]
    public function it_can_be_computed(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertFalse($column->isComputed());

        $column->computed();

        $this->assertTrue($column->isComputed());
    }
}
