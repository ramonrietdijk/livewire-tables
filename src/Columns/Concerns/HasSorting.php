<?php

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Enums\Direction;

trait HasSorting
{
    protected bool $sortable = false;

    protected ?Closure $sortCallback = null;

    public function sortable(bool|Closure $sortable = true): static
    {
        if (is_bool($sortable)) {
            $this->sortable = $sortable;
            $this->sortCallback = null;
        } else {
            $this->sortable = true;
            $this->sortCallback = $sortable;
        }

        return $this;
    }

    public function isSortable(): bool
    {
        return $this->sortable;
    }

    public function sortCallback(): ?Closure
    {
        return $this->sortCallback;
    }

    /** @param  Builder<covariant Model>  $builder */
    public function sort(Builder $builder, Direction $direction): void
    {
        $builder->orderBy($this->qualify($builder), $direction->value);
    }

    /** @param  Builder<covariant Model>  $builder */
    public function applySorting(Builder $builder, Direction $direction): void
    {
        if ($this->sortCallback !== null) {
            call_user_func($this->sortCallback, $builder, $direction);

            return;
        }

        if (! $this->isComputed()) {
            $this->sort($builder, $direction);
        }
    }
}
