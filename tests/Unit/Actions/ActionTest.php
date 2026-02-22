<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Actions;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Tests\TestCase;

final class ActionTest extends TestCase
{
    #[Test]
    public function it_can_be_created_with_a_callback(): void
    {
        $action = Action::make('Action', fn (): bool => true, 'code');

        $this->assertSame('Action', $action->label());
        $this->assertSame('code', $action->code());
        $this->assertNull($action->script());
        $this->assertInstanceOf(Closure::class, $action->callback());
    }

    #[Test]
    public function it_can_be_created_with_a_script(): void
    {
        $action = Action::make('Action', 'JavaScript', 'code');

        $this->assertSame('Action', $action->label());
        $this->assertSame('code', $action->code());
        $this->assertNotNull($action->script());
        $this->assertNotInstanceOf(Closure::class, $action->callback());
    }

    #[Test]
    public function it_can_generate_the_code(): void
    {
        $action = Action::make('Publish All', fn (): bool => true);

        $this->assertSame('publish_all', $action->code());
    }

    #[Test]
    public function it_can_execute_callbacks(): void
    {
        $action = Action::make('Action', fn (): bool => true);

        $result = $action->execute(
            Collection::make()
        );

        $this->assertTrue($result);
    }

    #[Test]
    public function it_wont_execute_scripts(): void
    {
        $action = Action::make('Action', 'JavaScript');

        $this->assertNotInstanceOf(Closure::class, $action->callback());

        $result = $action->execute(
            Collection::make()
        );

        $this->assertNull($result);
    }
}
