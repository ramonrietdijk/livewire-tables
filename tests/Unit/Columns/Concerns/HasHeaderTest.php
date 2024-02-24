<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns\Concerns;

use Illuminate\Contracts\View\View;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasHeaderTest extends TestCase
{
    #[Test]
    public function it_can_render_the_header(): void
    {
        $column = Column::make('Column', 'column');

        /** @var View $view */
        $view = $column->renderHeader();

        $data = $view->getData();
        $column = $data['column'] ?? null;

        $this->assertNotNull($column);
    }

    #[Test]
    public function it_can_disable_the_header(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertTrue($column->hasHeader());

        $column->header(false);

        $this->assertFalse($column->hasHeader());
    }
}
