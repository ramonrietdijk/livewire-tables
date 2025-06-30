<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class CanBeCopiedTest extends TestCase
{
    #[Test]
    public function it_can_be_copied(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertFalse($column->isCopyable());

        $column->copyable();

        $this->assertTrue($column->isCopyable());
    }
}
