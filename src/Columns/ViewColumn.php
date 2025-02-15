<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Columns;

use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Columns\Concerns\HasData;

class ViewColumn extends BaseColumn
{
    use HasData;

    protected bool $raw = true;

    protected bool $computed = true;

    public function resolveValue(Model $model): mixed
    {
        $view = $this->column();

        if ($this->displayUsing !== null) {
            $view = call_user_func($this->displayUsing, $model, $model);
        }

        if ($view === null) {
            return null;
        }

        return view($view)
            ->with('model', $model)
            ->with($this->data);
    }
}
