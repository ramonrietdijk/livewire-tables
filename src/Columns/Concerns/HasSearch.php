<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Enums\SearchScope;

/**
 * @property view-string $searchView
 */
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

    /** @param  Builder<covariant Model>  $builder */
    public function search(Builder $builder, SearchScope $scope, mixed $search): void
    {
        $this->qualifyQuery($builder, function (Builder $builder, string $column) use ($search): void {
            if (is_string($search)) {
                $builder->where($column, 'LIKE', '%'.$search.'%');
            }
        });
    }

    /** @param  Builder<covariant Model>  $builder */
    public function applySearch(Builder $builder, SearchScope $scope, mixed $search): void
    {
        if ($this->searchCallback !== null) {
            call_user_func($this->searchCallback, $builder, $search, $scope);

            return;
        }

        if (! $this->isComputed()) {
            $this->search($builder, $scope, $search);
        }
    }

    public function renderSearch(): mixed
    {
        return view($this->searchView, ['column' => $this]);
    }
}
