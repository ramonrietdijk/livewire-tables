<?php

namespace RamonRietdijk\LivewireTables\Filters\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasFilter
{
    protected ?Closure $filterUsing = null;

    public function filterUsing(?Closure $filterUsing = null): static
    {
        $this->filterUsing = $filterUsing;

        return $this;
    }

    public function filterUsingCallback(): ?Closure
    {
        return $this->filterUsing;
    }

    /** @param  Builder<Model>  $builder */
    public function filter(Builder $builder, mixed $value): void
    {
        $builder->when(! blank($value), function (Builder $builder) use ($value): void {
            $this->qualifyQuery($builder, function (Builder $builder, string $column) use ($value): void {
                if (is_array($value)) {
                    $builder->whereIn($column, $value);
                } else {
                    $builder->where($column, '=', $value);
                }
            });
        });
    }

    /** @param  Builder<Model>  $builder */
    public function applyFilter(Builder $builder, mixed $value): void
    {
        if ($this->filterUsing !== null) {
            call_user_func($this->filterUsing, $builder, $value);

            return;
        }

        if (! $this->isComputed()) {
            $this->filter($builder, $value);
        }
    }
}
