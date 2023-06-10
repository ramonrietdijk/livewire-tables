<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Columns\BaseColumn;
use RamonRietdijk\LivewireTables\Enums\Direction;

trait HasSorting
{
    public string $sortColumn = '';

    public string $sortDirection = '';

    /** @return array<string, mixed> */
    protected function queryStringHasSorting(): array
    {
        if (! $this->useQueryString) {
            return [];
        }

        return [
            'sortColumn' => [
                'except' => '',
                'as' => $this->getQueryStringName('sortColumn'),
            ],
            'sortDirection' => [
                'except' => '',
                'as' => $this->getQueryStringName('sortDirection'),
            ],
        ];
    }

    public function sort(string $column): void
    {
        $isEqual = $this->sortColumn === $column;
        $isAscending = $this->sortDirection === Direction::Ascending->value;

        if (! $isEqual) {
            $this->sortColumn = $column;
            $this->sortDirection = Direction::Ascending->value;
        } else {
            if ($isAscending) {
                $this->sortDirection = Direction::Descending->value;
            } else {
                $this->sortColumn = '';
                $this->sortDirection = '';
            }
        }
    }

    /** @param  Builder<Model>  $builder */
    protected function applySorting(Builder $builder): static
    {
        if (blank($this->sortColumn) || blank($this->sortDirection)) {
            return $this;
        }

        $direction = Direction::from($this->sortDirection);

        /** @var BaseColumn $column */
        $column = $this->resolveColumns()->firstOrFail(function (BaseColumn $column): bool {
            return $column->isSortable() && $column->code() === $this->sortColumn;
        });

        $column->applySorting($builder, $direction);

        return $this;
    }
}
