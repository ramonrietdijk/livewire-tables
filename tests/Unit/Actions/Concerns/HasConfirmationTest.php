<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Actions\Concerns;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Tests\TestCase;

final class HasConfirmationTest extends TestCase
{
    #[Test]
    public function it_can_have_a_confirmation(): void
    {
        $action = Action::make('Action', fn (): bool => true);

        $this->assertFalse($action->hasConfirmation());

        $action->confirmation();

        $this->assertTrue($action->hasConfirmation());

        $action->withoutConfirmation();

        $this->assertFalse($action->hasConfirmation());
    }

    #[Test]
    public function it_can_override_confirmation_data(): void
    {
        $action = Action::make('Action', fn (): bool => true);

        $this->assertSame([
            'type' => 'info',
            'title' => 'Action',
            'body' => 'Are you sure you want to run this action?',
            'cancel' => 'Cancel',
            'run' => 'Run',
        ], $action->getConfirmationData());

        $action->confirmation(
            title: '::title::',
            body: '::body::',
            cancel: '::cancel::',
            run: '::run::'
        );

        $this->assertSame([
            'type' => 'info',
            'title' => '::title::',
            'body' => '::body::',
            'cancel' => '::cancel::',
            'run' => '::run::',
        ], $action->getConfirmationData());
    }
}
