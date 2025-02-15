<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\SelectColumn;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasOptionsTest extends TestCase
{
    #[Test]
    public function it_can_have_options(): void
    {
        $column = SelectColumn::make('Column', 'column');

        $this->assertEmpty($column->getOptions());

        $options = [
            'John Doe',
            'Jane Doe',
        ];

        $column->options($options);

        $this->assertEquals($options, $column->getOptions());
    }
}
