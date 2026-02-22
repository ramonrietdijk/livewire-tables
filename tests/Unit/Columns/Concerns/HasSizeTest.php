<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\ImageColumn;
use RamonRietdijk\LivewireTables\Tests\TestCase;

final class HasSizeTest extends TestCase
{
    #[Test]
    public function it_can_set_a_size(): void
    {
        $column = ImageColumn::make('Image', 'image');

        $this->assertSame(32, $column->getWidth());
        $this->assertSame(32, $column->getHeight());

        $column->size(200, 100);

        $this->assertSame(200, $column->getWidth());
        $this->assertSame(100, $column->getHeight());
    }

    #[Test]
    public function it_can_set_a_width(): void
    {
        $column = ImageColumn::make('Image', 'image');

        $this->assertSame(32, $column->getWidth());

        $column->width(100);

        $this->assertSame(100, $column->getWidth());
    }

    #[Test]
    public function it_can_set_a_height(): void
    {
        $column = ImageColumn::make('Image', 'image');

        $this->assertSame(32, $column->getHeight());

        $column->height(100);

        $this->assertSame(100, $column->getHeight());
    }
}
