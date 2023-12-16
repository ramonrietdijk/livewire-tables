<?php

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use RamonRietdijk\LivewireTables\Support\Column;

trait HasValue
{
    protected ?Closure $displayUsing = null;

    public function displayUsing(?Closure $displayUsing = null): static
    {
        $this->displayUsing = $displayUsing;

        return $this;
    }

    public function displayUsingCallback(): ?Closure
    {
        return $this->displayUsing;
    }

    public function getValue(Model $model): mixed
    {
        $column = $this->column();

        if ($column === null) {
            return $model;
        }

        $segments = Column::make($column)->segments();

        $value = $model;

        foreach ($segments as $segment) {
            if ($value instanceof Collection) {
                $value = $value->pluck($segment);

                continue;
            }

            $value = data_get($value, str_replace('->', '.', $segment));
        }

        return $value;
    }

    public function resolveValue(Model $model): mixed
    {
        $value = $this->getValue($model);

        if ($this->displayUsing !== null) {
            return call_user_func($this->displayUsing, $value, $model);
        }

        if ($value instanceof Collection) {
            $value = $value->toArray();
        }

        if (is_array($value)) {
            $value = implode(', ', $value);
        }

        return $value;
    }
}
