<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Filters\BooleanFilter;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class BooleanFilterTest extends TestCase
{
    #[Test]
    public function it_can_apply_filters(): void
    {
        User::factory()->admin()->create();
        User::factory()->create();

        /** @var Builder<Model> $builder */
        $builder = User::query();

        $filter = BooleanFilter::make('Admin', 'is_admin');
        $filter->applyFilter($builder, true);

        $this->assertEquals(1, $builder->count());
    }
}
