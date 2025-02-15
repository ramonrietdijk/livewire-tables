<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class CanBeRawTest extends TestCase
{
    #[Test]
    public function it_can_be_raw(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertFalse($column->isRaw());

        $column->asHtml();

        $this->assertTrue($column->isRaw());
    }
}
