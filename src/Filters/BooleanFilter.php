<?php

namespace RamonRietdijk\LivewireTables\Filters;

use Illuminate\Database\Eloquent\Builder;

class BooleanFilter extends BaseFilter
{
    protected string $view = 'livewire-table::filters.boolean';

    public function filter(Builder $builder, mixed $value): void
    {
        $builder->when(! blank($value), function (Builder $builder) use ($value): void {
            $builder->where($this->qualify($builder), '=', (bool) $value);
        });
    }
}
