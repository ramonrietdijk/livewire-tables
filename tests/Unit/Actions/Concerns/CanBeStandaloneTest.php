<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Actions\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class CanBeStandaloneTest extends TestCase
{
    #[Test]
    public function it_can_be_standalone(): void
    {
        $action = Action::make('Action', 'code', fn (): bool => true);

        $this->assertFalse($action->isStandalone());

        $action->standalone();

        $this->assertTrue($action->isStandalone());
    }
}
