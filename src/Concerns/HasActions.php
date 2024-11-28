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
        return once(fn (): Enumerable => collect($this->actions()));
    }

    public function executeAction(string $code): mixed
    {
        /** @var BaseAction $action */
        $action = $this->resolveActions()->firstOrFail(fn (BaseAction $action): bool => $code === $action->code());

        $models = collect();

        if (! $action->isStandalone() && count($this->selected) > 0) {
            $models = $this->query()->whereIn($this->model()->getQualifiedKeyName(), $this->selected)->get();
        }

        $response = $action->execute($models);

        if ($response !== false) {
            if (! $action->isStandalone()) {
                $this->clearSelection();
            }

            $this->dispatch('refreshLivewireTable');
        }

        return $response;
    }
}
