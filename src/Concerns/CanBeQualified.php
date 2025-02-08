<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Exceptions\ColumnException;
use RamonRietdijk\LivewireTables\Support\Column;

trait CanBeQualified
{
    protected bool $qualifyUsingAlias = false;

    public function qualifyUsingAlias(bool $qualifyUsingAlias = true): static
    {
        $this->qualifyUsingAlias = $qualifyUsingAlias;

        return $this;
    }

    public function shouldQualifyUsingAlias(): bool
    {
        return $this->qualifyUsingAlias;
    }

    /** @param  Builder<covariant Model>  $builder */
    public function qualify(Builder $builder): string
    {
        $column = $this->column();

        if ($column === null) {
            throw new ColumnException('No column has been set');
        }

        return Column::make($column)->qualify($builder);
    }

    /** @param  Builder<covariant Model>  $builder */
    public function qualifyQuery(Builder $builder, Closure $callback): void
    {
        $column = $this->column();

        if ($column === null) {
            throw new ColumnException('No column has been set');
        }

        $column = Column::make($column);

        if ($column->hasRelation() && ! $this->shouldQualifyUsingAlias()) {
            $builder->whereHas($column->relation(), function (Builder $builder) use ($callback, $column): void {
                call_user_func($callback, $builder, $builder->qualifyColumn($column->name()));
            });
        } else {
            call_user_func($callback, $builder, $column->qualify($builder));
        }
    }
}
