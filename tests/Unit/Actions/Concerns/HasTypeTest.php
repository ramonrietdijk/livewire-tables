<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Actions\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasTypeTest extends TestCase
{
    #[Test]
    public function it_can_be_a_bulk_action(): void
    {
        $action = Action::make('Action', 'code', fn (): bool => true);

        $this->assertTrue($action->isBulk());

        $action->bulk();

        $this->assertTrue($action->isBulk());
    }

    #[Test]
    public function it_can_be_a_standalone_action(): void
    {
        $action = Action::make('Action', 'code', fn (): bool => true);

        $this->assertFalse($action->isStandalone());

        $action->standalone();

        $this->assertTrue($action->isStandalone());
    }

    #[Test]
    public function it_can_be_a_record_action(): void
    {
        $action = Action::make('Action', 'code', fn (): bool => true);

        $this->assertFalse($action->isRecord());

        $action->record();

        $this->assertTrue($action->isRecord());
    }
}
