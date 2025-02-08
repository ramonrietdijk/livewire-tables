<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use RamonRietdijk\LivewireTables\Columns\BaseColumn;
use RamonRietdijk\LivewireTables\Filters\BaseFilter;
use RamonRietdijk\LivewireTables\Support\Column;

trait HasRelations
{
    /** @param  Builder<covariant Model>  $builder */
    protected function applyRelations(Builder $builder): static
    {
        $columns = $this->resolveColumns()
            ->filter(fn (BaseColumn $column): bool => ! $column->isComputed())
            ->map(fn (BaseColumn $column): ?string => $column->column());

        $filters = $this->resolveFilters()
            ->filter(fn (BaseFilter $filter): bool => ! $filter->isComputed())
            ->map(fn (BaseFilter $filter): ?string => $filter->column());

        $allColumns = $columns
            ->merge($filters)
            ->filter(fn (?string $column): bool => $column !== null)
            ->unique()
            ->values();

        $with = [];
        $join = [];
        $lookup = [];

        foreach ($allColumns as $column) {
            $segments = Column::make($column)->segments();

            /** @var Collection<int, string> $previous */
            $previous = collect();

            /** @var Model $model */
            $model = $builder->getModel();

            $alias = null;
            $shouldJoin = true;

            foreach ($segments as $segment) {
                $relation = $this->getEloquentRelation($model, $segment);

                if ($relation === null) {
                    break;
                }

                $fullRelation = $previous->push($segment)->implode('.');

                if (! in_array($fullRelation, $with, true)) {
                    $with[] = $fullRelation;
                }

                if (! in_array($fullRelation, $join, true) && $shouldJoin) {
                    $join[] = $fullRelation;

                    $lookup[$fullRelation] = $this->joinEloquentRelation($builder, $relation, $model, $segment, $alias);
                }

                if (! isset($lookup[$fullRelation])) {
                    $shouldJoin = false;
                }

                if ($shouldJoin) {
                    /** @var string $alias */
                    $alias = $lookup[$fullRelation];
                }

                $model = $relation->getRelated();
            }
        }

        $builder->with($with);

        return $this;
    }

    /** @return ?Relation<covariant Model, covariant Model, mixed> */
    protected function getEloquentRelation(Model $model, string $relation): ?Relation
    {
        if (! method_exists($model, $relation)) {
            return null;
        }

        $relation = $model->$relation();

        if (! ($relation instanceof Relation)) {
            return null;
        }

        return $relation;
    }

    /**
     * @param  Builder<covariant Model>  $builder
     * @param  Relation<covariant Model, covariant Model, mixed>  $relation
     */
    protected function joinEloquentRelation(Builder $builder, Relation $relation, Model $model, string $name, ?string $parent = null): ?string
    {
        $method = 'join'.class_basename($relation);

        if (! method_exists($this, $method)) {
            return null;
        }

        return $this->$method($builder, $relation, $model, $name, $parent);
    }

    /**
     * @param  Builder<covariant Model>  $builder
     * @param  BelongsTo<covariant Model, covariant Model>  $relation
     */
    protected function joinBelongsTo(Builder $builder, BelongsTo $relation, Model $model, string $name, ?string $parent = null): string
    {
        /** @var Model $subModel */
        $subModel = $relation->getModel();

        $alias = $parent !== null
            ? $parent.'_'.$name
            : $name;

        $parentTable = $parent ?? $model->getTable();

        $builder->leftJoin(
            $subModel->getTable().' AS '.$alias,
            $alias.'.'.$relation->getOwnerKeyName(),
            '=',
            $parentTable.'.'.$relation->getForeignKeyName()
        );

        return $alias;
    }
}
