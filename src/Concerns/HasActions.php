<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Support\Enumerable;
use RamonRietdijk\LivewireTables\Actions\BaseAction;

trait HasActions
{
    /** @return array<int, BaseAction> */
    protected function actions(): array
    {
        return [
            //
        ];
    }

    /** @return Enumerable<int, BaseAction> */
    protected function resolveActions(): Enumerable
    {
        return collect($this->actions());
    }

    public function executeAction(string $code): void
    {
        /** @var BaseAction $action */
        $action = $this->resolveActions()->firstOrFail(fn (BaseAction $action): bool => $action->code() === $code);

        $models = collect();

        if (! $action->isStandalone() && count($this->selected) > 0) {
            $models = $this->query()->whereIn($this->model()->getKeyName(), $this->selected)->get();
        }

        $status = $action->execute($models);

        if ($status !== false) {
            $this->clearSelection();
            $this->emit('refreshLivewireTable');
        }
    }
}
