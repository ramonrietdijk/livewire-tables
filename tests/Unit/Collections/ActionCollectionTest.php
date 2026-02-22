<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Collections;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Collections\ActionCollection;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

final class ActionCollectionTest extends TestCase
{
    #[Test]
    public function it_can_get_bulk_actions(): void
    {
        $items = [
            Action::make('Action', function (): void {
                //
            })->bulk(),
        ];

        $collection = ActionCollection::make($items);

        $this->assertCount(1, $collection->bulk());
        $this->assertCount(0, $collection->bulk(false));
    }

    #[Test]
    public function it_can_get_standalone_actions(): void
    {
        $items = [
            Action::make('Action', function (): void {
                //
            })->standalone(),
        ];

        $collection = ActionCollection::make($items);

        $this->assertCount(1, $collection->standalone());
        $this->assertCount(0, $collection->standalone(false));
    }

    #[Test]
    public function it_can_get_record_actions(): void
    {
        $items = [
            Action::make('Action', function (): void {
                //
            })->record(),
        ];

        $collection = ActionCollection::make($items);

        $this->assertCount(1, $collection->record());
        $this->assertCount(0, $collection->record(false));
    }

    #[Test]
    public function it_can_get_runnable_actions(): void
    {
        $items = [
            Action::make('Action', function (): void {
                //
            })->canRun(fn (Model $model): bool => $model->exists),
        ];

        $collection = ActionCollection::make($items);

        $model = new User;

        $this->assertCount(1, $collection);
        $this->assertCount(0, $collection->canBeRun($model));
    }
}
