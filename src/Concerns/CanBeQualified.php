<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait CanBeQualified
{
    /** @param  Builder<Model>  $builder */
    public function qualify(Builder $builder): string
    {
        $column = $this->column();

        if ($column === null) {
            throw new Exception('No column has been set');
        }

        $segments = Str::of($column)->explode('.');

        /** @var string $columnName */
        $columnName = $segments->last();
        $relations = $segments->slice(0, -1);

        $alias = $relations->implode('_');

        return strlen($alias) > 0
            ? $alias.'.'.$columnName
            : $builder->qualifyColumn($columnName);
    }
}
