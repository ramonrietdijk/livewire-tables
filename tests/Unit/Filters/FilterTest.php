<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Filters\SelectFilter;
use RamonRietdijk\LivewireTables\Tests\TestCase;

final class FilterTest extends TestCase
{
    #[Test]
    public function it_can_get_the_label_and_column_and_code(): void
    {
        $filter = SelectFilter::make('Company', 'author.company.id');

        $this->assertSame('Company', $filter->label());
        $this->assertSame('author.company.id', $filter->column());
        $this->assertSame('author_company_id', $filter->code());
    }

    #[Test]
    public function it_can_be_created_with_a_callback(): void
    {
        $filter = SelectFilter::make('Company', function (Builder $builder, mixed $value): void {
            //
        });

        $this->assertNull($filter->column());
        $this->assertSame(md5('Company'), $filter->code());
        $this->assertInstanceOf(Closure::class, $filter->filterUsingCallback());
        $this->assertTrue($filter->isComputed());
    }

    #[Test]
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
