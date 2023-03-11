<?php

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Model;

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
        $value = $model;

        if (($column = $this->column()) !== null) {
            foreach (explode('.', $column) as $segment) {
                $value = $value?->$segment;
            }
        }

        return $value;
    }

    public function resolveValue(Model $model): mixed
    {
        $value = $this->getValue($model);

        if ($this->displayUsing !== null) {
            return call_user_func($this->displayUsing, $value, $model);
        }

        return $value;
    }
}
