<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasMetadataTest extends TestCase
{
    #[Test]
    public function it_can_interact_with_metadata(): void
    {
        $column = Column::make('Label', 'code')->setMeta('key', 'value');

        $this->assertEquals('value', $column->getMeta('key'));
    }
}
