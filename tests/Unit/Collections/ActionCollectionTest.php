<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Collections;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Collections\ActionCollection;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class ActionCollectionTest extends TestCase
{
    #[Test]
    public function it_can_get_bulk_actions(): void
    {
        $items = [
            Action::make('Action', 'action', function (): void {
                //
            })->bulk(),
        ];

        $collection = ActionCollection::make($items);

        $this->assertEquals(1, $collection->bulk()->count());
        $this->assertEquals(0, $collection->bulk(false)->count());
    }

    #[Test]
    public function it_can_get_standalone_actions(): void
    {
        $items = [
            Action::make('Action', 'action', function (): void {
                //
            })->standalone(),
        ];

        $collection = ActionCollection::make($items);

        $this->assertEquals(1, $collection->standalone()->count());
        $this->assertEquals(0, $collection->standalone(false)->count());
    }

    #[Test]
    public function it_can_get_record_actions(): void
    {
        $items = [
            Action::make('Action', 'action', function (): void {
                //
            })->record(),
        ];

        $collection = ActionCollection::make($items);

        $this->assertEquals(1, $collection->record()->count());
        $this->assertEquals(0, $collection->record(false)->count());
    }
}
