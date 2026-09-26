<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Actions\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Enums\ActionType;
use RamonRietdijk\LivewireTables\Tests\TestCase;

final class HasTypeTest extends TestCase
{
    #[Test]
    public function it_can_be_a_bulk_action(): void
    {
        $action = Action::make('Action', fn (): bool => true);

        $this->assertTrue($action->isBulk());
        $this->assertSame(ActionType::Bulk, $action->getType());

        $action->bulk();

        $this->assertTrue($action->isBulk());
        $this->assertSame(ActionType::Bulk, $action->getType());
    }

    #[Test]
    public function it_can_be_a_standalone_action(): void
    {
        $action = Action::make('Action', fn (): bool => true);

        $this->assertFalse($action->isStandalone());
        $this->assertSame(ActionType::Bulk, $action->getType());

        $action->standalone();

        $this->assertTrue($action->isStandalone());
        $this->assertSame(ActionType::Standalone, $action->getType());
    }

    #[Test]
    public function it_can_be_a_record_action(): void
    {
        $action = Action::make('Action', fn (): bool => true);

        $this->assertFalse($action->isRecord());
        $this->assertSame(ActionType::Bulk, $action->getType());

        $action->record();

        $this->assertTrue($action->isRecord());
        $this->assertSame(ActionType::Record, $action->getType());
    }
}
