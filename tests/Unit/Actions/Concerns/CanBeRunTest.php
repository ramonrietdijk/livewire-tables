<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Actions\Concerns;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class CanBeRunTest extends TestCase
{
    #[Test]
    public function it_can_be_run(): void
    {
        $action = Action::make('Action', fn (): bool => true);
        $model = new User;

        $this->assertTrue($action->canBeRun($model));
        $this->assertNull($action->canRunCallback());

        $action->canRun(fn (Model $model): bool => $model->exists);

        $this->assertFalse($action->canBeRun($model));
        $this->assertNotNull($action->canRunCallback());
    }
}
