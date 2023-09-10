<?php

namespace RamonRietdijk\LivewireTables\Columns;

use Illuminate\Database\Eloquent\Model;

class ViewColumn extends BaseColumn
{
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

        return view($view, [
            'model' => $model,
        ]);
    }
}
