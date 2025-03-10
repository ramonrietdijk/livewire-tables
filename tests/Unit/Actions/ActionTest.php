<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Actions;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class ActionTest extends TestCase
{
    #[Test]
    public function it_can_get_the_label_and_code(): void
    {
        $action = Action::make('Action', 'code', fn (): bool => true);

        $this->assertEquals('Action', $action->label());
        $this->assertEquals('code', $action->code());
        $this->assertNotNull($action->callback());
    }

    #[Test]
    public function it_can_be_executed(): void
    {
        $action = Action::make('Action', 'code', fn (): bool => true);

        $result = $action->execute(collect());

        $this->assertTrue($result);
    }

    #[Test]
    public function it_can_be_used_as_javascript(): void
    {
        $action = Action::make('Action', 'javascript');

        $this->assertNull($action->callback());

        $result = $action->execute(collect());

        $this->assertNull($result);
    }
}
