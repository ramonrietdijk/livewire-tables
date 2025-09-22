<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Collections;

use RamonRietdijk\LivewireTables\Filters\BaseFilter;

/**
 * @extends BaseCollection<int, BaseFilter>
 */
class FilterCollection extends BaseCollection
{
    public function computed(bool $computed = true): static
    {
        return $this->filter(fn (BaseFilter $filter): bool => $filter->isComputed() === $computed);
    }

    /** @return array<int, ?string> */
    public function columns(): array
    {
        return $this->collect()->map(fn (BaseFilter $filter): ?string => $filter->column())->all();
    }
}
