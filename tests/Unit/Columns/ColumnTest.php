<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns;

use Closure;
use Illuminate\Contracts\View\View;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

final class ColumnTest extends TestCase
{
    #[Test]
    public function it_can_get_the_label_and_column_and_code(): void
    {
        $column = Column::make('Company', 'author.company.name');

        $this->assertSame('Company', $column->label());
        $this->assertSame('author.company.name', $column->column());
        $this->assertSame('author_company_name', $column->code());
    }

    #[Test]
    public function it_can_be_created_with_a_callback(): void
    {
        $column = Column::make('Company', fn (): string => '');

        $this->assertNull($column->column());
        $this->assertSame(md5('Company'), $column->code());
        $this->assertInstanceOf(Closure::class, $column->displayUsingCallback());
        $this->assertTrue($column->isComputed());
    }

    #[Test]
    public function it_can_render(): void
    {
        $column = Column::make('Name', 'name');

        /** @var User $user */
        $user = User::factory()->create();

        /** @var View $view */
        $view = $column->render($user);

        $data = $view->getData();
        $value = $data['value'] ?? null;

        $this->assertNotNull($value);
    }
}
