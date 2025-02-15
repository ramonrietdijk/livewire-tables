<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Filters;

use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Filters\DateFilter;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class DateFilterTest extends TestCase
{
    #[Test]
    public function it_can_apply_filters(): void
    {
        User::factory()->create(['created_at' => now()]);
        User::factory()->create(['created_at' => now()->subMonth()]);
        User::factory()->create(['created_at' => now()->addMonth()]);

        $builder = User::query();

        $filter = DateFilter::make('Created At', 'created_at');
        $filter->applyFilter($builder, [
            'from' => now()->subWeek()->format('Y-m-d'),
            'to' => now()->addWeek()->format('Y-m-d'),
        ]);

        $this->assertEquals(1, $builder->count());
    }
}
