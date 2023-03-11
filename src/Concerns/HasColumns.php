<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Support\Enumerable;
use RamonRietdijk\LivewireTables\Columns\BaseColumn;

trait HasColumns
{
    /** @var array<int, string> */
    public array $columns = [];

    public function selectAllColumns(bool $select): void
    {
        /** @var array<int, string> $columns */
        $columns = $select
            ? $this->resolveColumns()->map(fn (BaseColumn $column): string => $column->code())->toArray()
            : [];

        $this->columns = $columns;
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
        return collect($this->columns());
    }
}
