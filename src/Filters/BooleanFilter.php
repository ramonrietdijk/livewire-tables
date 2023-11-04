<?php

namespace RamonRietdijk\LivewireTables\Filters;

use Illuminate\Database\Eloquent\Builder;

class BooleanFilter extends BaseFilter
{
    protected string $view = 'livewire-table::filters.boolean';

    public function filter(Builder $builder, mixed $value): void
    {
        if (! blank($value)) {
            parent::filter($builder, (bool) $value);
        }
    }
}
