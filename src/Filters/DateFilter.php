<?php

namespace RamonRietdijk\LivewireTables\Filters;

use Illuminate\Database\Eloquent\Builder;

class DateFilter extends BaseFilter
{
    protected string $view = 'livewire-table::filters.date';

    /** @param  array<string, string>  $value */
    public function filter(Builder $builder, mixed $value): void
    {
        $from = $value['from'] ?? null;
        $to = $value['to'] ?? null;

        $builder->when($from, function (Builder $builder, ?string $from): void {
            $builder->whereDate($this->qualify($builder), '>=', $from);
        });

        $builder->when($to, function (Builder $builder, ?string $to): void {
            $builder->whereDate($this->qualify($builder), '<=', $to);
        });
    }
}
