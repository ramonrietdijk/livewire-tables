<?php

namespace RamonRietdijk\LivewireTables\Tests\Integration\Concerns;

use Exception;
use Livewire\Livewire;
use RamonRietdijk\LivewireTables\Tests\Fakes\Http\Livewire\InvalidRelationTypeBlogLivewireTable;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasRelationsTest extends TestCase
{
    /** @test */
    public function it_can_throw_exceptions(): void
    {
        $this->expectException(Exception::class);

        Livewire::test(InvalidRelationTypeBlogLivewireTable::class);
    }
}
