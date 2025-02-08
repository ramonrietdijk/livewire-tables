<?php

namespace RamonRietdijk\LivewireTables\Columns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Concerns\HasOptions;

class SelectColumn extends BaseColumn
{
    use HasOptions;

    protected string $searchView = 'livewire-table::columns.search.select';

    /** @param  Builder<covariant Model>  $builder */
    public function search(Builder $builder, mixed $search): void
    {
        $this->qualifyQuery($builder, function (Builder $builder, string $column) use ($search): void {
            $builder->where($column, '=', $search);
        });
    }
}
