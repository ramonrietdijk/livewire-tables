<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class CanBeSeenTest extends TestCase
{
    #[Test]
    public function it_can_see_columns_with_booleans(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertTrue($column->canBeSeen());

        $column->canSee(false);

        $this->assertFalse($column->canBeSeen());
    }

    #[Test]
    public function it_can_see_columns_with_callbacks(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertTrue($column->canBeSeen());

        $column->canSee(fn (): bool => false);

        $this->assertFalse($column->canBeSeen());
    }
}
