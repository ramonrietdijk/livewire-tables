<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Actions\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasKindTest extends TestCase
{
    #[Test]
    public function it_can_have_a_callback(): void
    {
        $action = Action::make('Action', fn (): bool => true);

        $this->assertTrue($action->isCallback());
    }

    #[Test]
    public function it_can_have_a_script(): void
    {
        $action = Action::make('Action', 'JavaScript');

        $this->assertTrue($action->isScript());
    }
}
