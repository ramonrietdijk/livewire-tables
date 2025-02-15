<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Support\Enumerable;
use RamonRietdijk\LivewireTables\Columns\BaseColumn;

trait HasColumns
{
    /** @var array<int, string> */
    public array $columns = [];

    /** @var array<int, string> */
    public array $columnOrder = [];

    public function selectAllColumns(bool $select): void
    {
        /** @var array<int, string> $columns */
        $columns = $select
            ? $this->resolveColumns()->map(fn (BaseColumn $column): string => $column->code())->toArray()
            : [];

        $this->columns = $columns;

        $this->updateSession();
    }

    public function reorderColumn(string $from, string $to, bool $above): void
    {
        if ($from === $to) {
            return;
        }

        $currentOrder = (int) array_search($from, $this->columnOrder, true);

        $toOrder = (int) array_search($to, $this->columnOrder, true);

        $up = $toOrder > $currentOrder;

        if ($above && $up) {
            $newOrder = $toOrder - 1;
        } elseif (! $above && ! $up) {
            $newOrder = $toOrder + 1;
        } else {
            $newOrder = $toOrder;
        }

        if ($newOrder === $currentOrder) {
            return;
        }

        $columnOrder = $this->columnOrder;

        $removedColumn = array_splice($columnOrder, $currentOrder, 1);

        array_splice($columnOrder, $newOrder, 0, $removedColumn);

        $this->columnOrder = array_values($columnOrder);

        $this->updateSession();
    }

    protected function initializeColumns(): static
    {
        $columns = $this->resolveColumns();

        if (count($this->columns) === 0) {
            /** @var array<int, string> $visibleColumns */
            $visibleColumns = $columns
                ->filter(fn (BaseColumn $column): bool => $column->isVisible())
                ->map(fn (BaseColumn $column): string => $column->code())
                ->values()
                ->toArray();

            $this->columns = $visibleColumns;
        }

        /** @var array<int, string> $codes */
        $codes = $columns->map(fn (BaseColumn $column): string => $column->code())->toArray();

        $this->columnOrder = array_unique(array_merge($this->columnOrder, $codes));

        return $this;
    }

    /** @return array<int, BaseColumn> */
    protected function columns(): array
    {
        return [
            //
        ];
    }

    /** @return Enumerable<int, BaseColumn> */
    protected function resolveColumns(): Enumerable
    {
        return once(function (): Enumerable {
            return collect($this->columns())
                ->sortBy(function (BaseColumn $column): int {
                    return (int) array_search($column->code(), $this->columnOrder, true);
                })->values();
        });
    }
}
