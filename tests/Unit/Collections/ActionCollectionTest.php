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
}
