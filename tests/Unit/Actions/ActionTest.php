<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Actions;

use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class ActionTest extends TestCase
{
    /** @test */
    public function it_can_get_the_label_and_code(): void
    {
        $action = Action::make('Action', 'code', fn (): bool => true);

        $this->assertEquals('Action', $action->label());
        $this->assertEquals('code', $action->code());
    }

    /** @test */
    public function it_can_be_executed(): void
    {
        $action = Action::make('Action', 'code', fn (): bool => true);

        $result = $action->execute(collect());

        $this->assertTrue($result);
    }
}
