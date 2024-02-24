<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns\Concerns;

use Illuminate\Contracts\View\View;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasFooterTest extends TestCase
{
    #[Test]
    public function it_can_have_a_footer(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertFalse($column->hasFooter());
        $this->assertNull($column->getFooterContent());

        $column->footer(fn (): string => 'footer');

        $this->assertTrue($column->hasFooter());
        $this->assertEquals('footer', $column->getFooterContent());
    }

    #[Test]
    public function it_can_render_the_footer(): void
    {
        $column = Column::make('Column', 'column');

        /** @var View $view */
        $view = $column->renderFooter();

        $data = $view->getData();
        $column = $data['column'] ?? null;

        $this->assertNotNull($column);
    }
}
