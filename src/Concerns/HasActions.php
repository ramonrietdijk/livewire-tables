<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

use RamonRietdijk\LivewireTables\Actions\BaseAction;
use RamonRietdijk\LivewireTables\Collections\ActionCollection;

trait HasActions
{
    /** @return array<int, BaseAction> */
    protected function actions(): array
    {
        return [
            //
        ];
    }

    protected function resolveActions(): ActionCollection
    {
        return once(function (): ActionCollection {
            return collect($this->actions())
                ->filter(fn (BaseAction $action): bool => $action->canBeSeen())
                ->values()
                ->pipeInto(ActionCollection::class);
        });
    }

    /** @param array<int, string> $items */
    protected function runAction(string $code, array $items = []): mixed
    {
        /** @var BaseAction $action */
        $action = $this->resolveActions()->firstOrFail(fn (BaseAction $action): bool => $code === $action->code());

        $models = collect();

        if (! $action->isStandalone() && count($items) > 0) {
            $models = $this->queryWithTrashed()->whereIn($this->model()->getQualifiedKeyName(), $items)->get();
        }

        $response = $action->execute($models);

        if ($action->shouldClearSelection()) {
            $this->clearSelection();
        }

        return $response;
    }

    public function executeAction(string $code): mixed
    {
        return $this->runAction($code, $this->selected);
    }

    public function executeItemAction(string $code, string $key): mixed
    {
        return $this->runAction($code, [$key]);
    }
}
