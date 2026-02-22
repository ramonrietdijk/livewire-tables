<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Filters;

use Illuminate\Database\Eloquent\Builder;
use Override;

class BooleanFilter extends BaseFilter
{
    protected string $view = 'livewire-table::filters.boolean';

    #[Override]
    public function filter(Builder $builder, mixed $value): void
    {
        if (! blank($value)) {
            parent::filter($builder, (bool) $value);
        }
    }
}
