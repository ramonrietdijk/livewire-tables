<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Actions\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Enums\ActionVariant;
use RamonRietdijk\LivewireTables\Tests\TestCase;

final class HasVariantTest extends TestCase
{
    #[Test]
    public function it_can_be_of_variant_info(): void
    {
        $action = Action::make('Action', fn (): bool => true);

        $this->assertTrue($action->isInfo());
        $this->assertSame(ActionVariant::Info, $action->getVariant());

        $action->info();

        $this->assertTrue($action->isInfo());
        $this->assertSame(ActionVariant::Info, $action->getVariant());
    }

    #[Test]
    public function it_can_be_of_variant_danger(): void
    {
        $action = Action::make('Action', fn (): bool => true);

        $this->assertFalse($action->isDanger());
        $this->assertNotSame(ActionVariant::Danger, $action->getVariant());

        $action->danger();

        $this->assertTrue($action->isDanger());
        $this->assertSame(ActionVariant::Danger, $action->getVariant());
    }
}
