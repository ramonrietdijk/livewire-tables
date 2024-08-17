<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Enumerable;
use RamonRietdijk\LivewireTables\Filters\BaseFilter;

trait HasFilters
{
    /** @var array<string, mixed> */
    public array $filters = [];

    /** @return array<string, mixed> */
    protected function queryStringHasFilters(): array
    {
        if (! $this->useQueryString) {
            return [];
        }

        return [
            'filters' => [
                'as' => $this->getQueryStringName('filters'),
            ],
        ];
    }

    public function updatedFilters(mixed $value, ?string $key): void
    {
        if (blank($value) && $key !== null) {
            unset($this->filters[$key]);
        }

        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->filters = [];

        $this->updateSession();
    }

    protected function canClearFilters(): bool
    {
        return count($this->filters) > 0;
    }

    /** @return array<int, BaseFilter> */
    protected function filters(): array
    {
        return [
            //
        ];
    }

    /** @return Enumerable<int, BaseFilter> */
    protected function resolveFilters(): Enumerable
    {
        return collect($this->filters());
    }

    /** @param  Builder<Model>  $builder */
    protected function applyFilters(Builder $builder): static
    {
        $builder->where(function (Builder $builder): void {
            $this->resolveFilters()->each(function (BaseFilter $filter) use ($builder): void {
                $value = $this->filters[$filter->code()] ?? null;

                $builder->where(fn (Builder $builder) => $filter->applyFilter($builder, $value));
            });
        });

        return $this;
    }
}
