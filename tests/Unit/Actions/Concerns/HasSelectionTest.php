<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Actions\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Tests\TestCase;

final class HasSelectionTest extends TestCase
{
    #[Test]
    public function it_can_keep_the_selection(): void
    {
        $action = Action::make('Action', fn (): bool => true);

        $this->assertTrue($action->shouldClearSelection());

        $action->keepSelection();

        $this->assertFalse($action->shouldClearSelection());
    }
}
