<?php

namespace RamonRietdijk\LivewireTables\Filters;

use Illuminate\Database\Eloquent\Builder;

class DateFilter extends BaseFilter
{
    protected string $view = 'livewire-table::filters.date';

    public function filter(Builder $builder, mixed $value): void
    {
        /** @var array<string, string> $value */
        $from = $value['from'] ?? null;
        $to = $value['to'] ?? null;

        $builder->when($from, function (Builder $builder, ?string $from): void {
            $this->qualifyQuery($builder, function (Builder $builder, string $column) use ($from): void {
                $builder->whereDate($column, '>=', $from);
            });
        });

        $builder->when($to, function (Builder $builder, ?string $to): void {
            $this->qualifyQuery($builder, function (Builder $builder, string $column) use ($to): void {
                $builder->whereDate($column, '<=', $to);
            });
        });
    }
}
