<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use RamonRietdijk\LivewireTables\Columns\BaseColumn;
use RamonRietdijk\LivewireTables\Filters\BaseFilter;

trait HasRelations
{
    /** @param  Builder<Model>  $builder */
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
        $lookup = [];

        foreach ($allColumns as $column) {
            /** @var Collection<int, string> $relations */
            $relations = Str::of($column)->explode('.')->slice(0, -1);

            /** @var Collection<int, string> $previous */
            $previous = collect();

            /** @var Model $model */
            $model = $builder->getModel();

            $alias = null;

            foreach ($relations as $relation) {
                $fullRelation = $previous->push($relation)->implode('.');

                if (! in_array($fullRelation, $with)) {
                    $with[] = $fullRelation;

                    $lookup[$fullRelation] = $this->joinRelation($builder, $model, $relation, $alias);
                }

                /**
                 * @var Model $model
                 * @var ?string $alias
                 */
                [$model, $alias] = $lookup[$fullRelation];
            }
        }

        $builder->with($with);

        return $this;
    }

    /**
     * @param  Builder<Model>  $builder
     * @return array<int, mixed>
     */
    protected function joinRelation(Builder $builder, Model $model, string $name, ?string $parent = null): array
    {
        /** @var Relation<Model> $relation */
        $relation = $model->$name();

        $type = get_class($relation);

        switch ($type) {
            case BelongsTo::class:
                /**
                 * @var BelongsTo<Model, Model> $relation
                 * @var Model $subModel
                 */
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

                return [$subModel, $alias];
            default:
                throw new Exception('Relation "'.$type.'" is not supported');
        }
    }
}
