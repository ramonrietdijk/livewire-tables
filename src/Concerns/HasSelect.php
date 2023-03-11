<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasSelect
{
    /** @param  Builder<Model>  $builder */
    protected function applySelect(Builder $builder): static
    {
        $builder->select($builder->qualifyColumn('*'));

        return $this;
    }
}
