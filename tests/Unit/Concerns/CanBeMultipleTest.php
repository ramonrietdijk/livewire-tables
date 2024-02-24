<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Filters\SelectFilter;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class CanBeMultipleTest extends TestCase
{
    #[Test]
    public function it_can_be_multiple(): void
    {
        $filter = SelectFilter::make('Name', 'name');

        $this->assertFalse($filter->isMultiple());

        $filter->multiple(true);

        $this->assertTrue($filter->isMultiple());
    }
}
