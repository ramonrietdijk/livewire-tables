<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasSelect
{
    /** @param  Builder<covariant Model>  $builder */
    protected function applySelect(Builder $builder): static
    {
        $builder->addSelect($builder->qualifyColumn('*'));

        return $this;
    }
}
