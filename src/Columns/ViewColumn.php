<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Columns;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Override;
use RamonRietdijk\LivewireTables\Columns\Concerns\HasData;

class ViewColumn extends BaseColumn
{
    use HasData;

    protected bool $raw = true;

    protected bool $computed = true;

    #[Override]
    public function resolveValue(Model $model): mixed
    {
        $view = $this->column();

        if (($callback = $this->displayUsingCallback()) instanceof Closure) {
            $view = call_user_func($callback, $model, $model);
        }

        if ($view === null) {
            return null;
        }

        return view($view)
            ->with('model', $model)
            ->with($this->data);
    }
}
