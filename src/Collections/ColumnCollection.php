<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Collections;

use RamonRietdijk\LivewireTables\Columns\BaseColumn;

/**
 * @extends BaseCollection<int, BaseColumn>
 */
class ColumnCollection extends BaseCollection
{
    public function searchable(bool $searchable = true): static
    {
        return $this->filter(fn (BaseColumn $column): bool => $column->isSearchable() === $searchable);
    }

    public function computed(bool $computed = true): static
    {
        return $this->filter(fn (BaseColumn $column): bool => $column->isComputed() === $computed);
    }

    /** @return array<int, ?string> */
    public function columns(): array
    {
        return $this->collect()->map(fn (BaseColumn $column): ?string => $column->column())->all();
    }
}
