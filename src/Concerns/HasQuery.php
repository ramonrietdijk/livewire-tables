<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasQuery
{
    /** @return Builder<covariant Model> */
    protected function query(): Builder
    {
        return $this->model()->query();
    }

    /** @return Builder<covariant Model> */
    protected function queryWithTrashed(): Builder
    {
        $query = $this->query();

        if ($this->hasSoftDeletes()) {
            $query->withTrashed(); // @phpstan-ignore-line
        }

        return $query;
    }

    /** @return Builder<covariant Model> */
    protected function appliedQuery(): Builder
    {
        $query = $this->query();

        $this
            ->applySelect($query)
            ->applySoftDeletes($query)
            ->applyRelations($query)
            ->applyGlobalSearch($query)
            ->applyColumnSearch($query)
            ->applyFilters($query)
            ->applySorting($query);

        return $query;
    }
}
