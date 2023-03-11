<?php

namespace RamonRietdijk\LivewireTables\Columns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use RamonRietdijk\LivewireTables\Columns\Concerns\HasFormat;

class DateColumn extends BaseColumn
{
    use HasFormat;

    protected string $searchView = 'livewire-table::columns.search.date';

    public function resolveValue(Model $model): mixed
    {
        /** @var string|Carbon|null $value */
        $value = $this->getValue($model);

        if ($this->displayUsing !== null) {
            return call_user_func($this->displayUsing, $value, $model);
        }

        if ($value === null) {
            return null;
        }

        /** @var Carbon $date */
        $date = Carbon::parse($value);

        return $this->format === null
            ? $date->toDateTimeString()
            : $date->format($this->format);
    }
}
