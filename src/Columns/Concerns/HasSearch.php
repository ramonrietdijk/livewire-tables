<?php

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use RamonRietdijk\LivewireTables\Columns\SelectColumn;

trait HasSearch
{
    protected string $searchView = 'livewire-table::columns.search.default';

    protected bool $searchable = false;

    protected ?Closure $searchCallback = null;

    public function searchable(bool|Closure $searchable = true): static
    {
        if (is_bool($searchable)) {
            $this->searchable = $searchable;
            $this->searchCallback = null;
        } else {
            $this->searchable = true;
            $this->searchCallback = $searchable;
        }

        return $this;
    }

    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    public function searchCallback(): ?Closure
    {
        return $this->searchCallback;
    }

    /** @param  Builder<Model>  $builder */
    public function search(Builder $builder, mixed $search): void
    {
        if ($this instanceof SelectColumn) {
            $this->qualifyQuery($builder, function (Builder $builder, string $column) use ($search): void {
                $builder->where($column, $search);
            });
        } else {
            $this->qualifyQuery($builder, function (Builder $builder, string $column) use ($search): void {
                $builder->where($column, 'LIKE', '%'.$search.'%');
            });
        }
    }

    /** @param  Builder<Model>  $builder */
    public function applySearch(Builder $builder, mixed $search): void
    {
        if ($this->searchCallback !== null) {
            call_user_func($this->searchCallback, $builder, $search);

            return;
        }

        if (! $this->isComputed()) {
            $this->search($builder, $search);
        }
    }

    public function renderSearch(): mixed
    {
        return view($this->searchView, ['column' => $this]);
    }
}
