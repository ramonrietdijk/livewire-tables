<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Filters;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use RamonRietdijk\LivewireTables\Filters\SelectFilter;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class FilterTest extends TestCase
{
    /** @test */
    public function it_can_get_the_label_and_column_and_code(): void
    {
        $filter = SelectFilter::make('Company', 'author.company.id');

        $this->assertEquals('Company', $filter->label());
        $this->assertEquals('author.company.id', $filter->column());
        $this->assertEquals('author_company_id', $filter->code());
    }

    /** @test */
    public function it_can_be_created_with_a_callback(): void
    {
        $filter = SelectFilter::make('Company', function (Builder $builder, mixed $value): void {
            //
        });

        $this->assertNull($filter->column());
        $this->assertEquals(md5('Company'), $filter->code());
        $this->assertNotNull($filter->filterUsingCallback());
        $this->assertTrue($filter->isComputed());
    }

    /** @test */
    public function it_can_render(): void
    {
        $filter = SelectFilter::make('Label', 'column');

        /** @var View $view */
        $view = $filter->render();

        $data = $view->getData();
        $value = $data['filter'] ?? null;

        $this->assertNotNull($value);
    }
}
