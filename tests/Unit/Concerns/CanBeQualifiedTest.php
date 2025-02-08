<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Concerns;

use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Exceptions\ColumnException;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class CanBeQualifiedTest extends TestCase
{
    #[Test]
    public function it_can_qualify_using_aliases(): void
    {
        $column = Column::make('Name', 'name');

        $this->assertFalse($column->shouldQualifyUsingAlias());

        $column->qualifyUsingAlias();

        $this->assertTrue($column->shouldQualifyUsingAlias());
    }

    #[Test]
    public function it_can_qualify_columns(): void
    {
        $builder = User::query();

        $column = Column::make('Name', 'name');

        $this->assertEquals('users.name', $column->qualify($builder));
    }

    #[Test]
    public function it_can_throw_exceptions_qualifying_columns_if_a_column_is_not_set(): void
    {
        $this->expectException(ColumnException::class);

        $builder = User::query();

        Column::make('Column', fn (): string => '')
            ->qualify($builder);
    }

    #[Test]
    #[DataProvider('qualifyQueries')]
    public function it_can_qualify_queries(string $column, bool $alias, string $expected): void
    {
        $builder = User::query();

        $value = null;

        Column::make('Column', $column)
            ->qualifyUsingAlias($alias)
            ->qualifyQuery($builder, function (Builder $builder, string $column) use (&$value): void {
                $value = $column;
            });

        $this->assertEquals($expected, $value);
    }

    /** @return array<string, array<string, mixed>> */
    public static function qualifyQueries(): array
    {
        return [
            'Default' => [
                'column' => 'name',
                'alias' => false,
                'expected' => 'users.name',
            ],
            'Relation via whereHas' => [
                'column' => 'company.name',
                'alias' => false,
                'expected' => 'companies.name',
            ],
            'Joined relation' => [
                'column' => 'author.company.name',
                'alias' => true,
                'expected' => 'author_company.name',
            ],
        ];
    }

    #[Test]
    public function it_can_throw_exceptions_qualifying_queries_if_a_column_is_not_set(): void
    {
        $this->expectException(ColumnException::class);

        $builder = User::query();

        Column::make('Column', fn (): string => '')
            ->qualifyQuery($builder, function (): void {
                //
            });
    }
}
