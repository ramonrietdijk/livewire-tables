<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasSelection
{
    /** @var array<int, string> */
    public array $selected = [];

    public bool $selectedPage = false;

    public function updatingSelectedPage(bool $selectedPage): void
    {
        $this->selectPage($selectedPage);
    }

    public function clearSelection(): void
    {
        $this->selected = [];
        $this->selectedPage = false;

        $this->updateSession();
    }

    public function selectItem(string $key): void
    {
        if (! $this->canSelect()) {
            return;
        }

        $selected = collect($this->selected);

        /** @var array<int, string> $newSelection */
        $newSelection = $selected->contains($key)
            ? $selected->diff([$key])->values()->toArray()
            : $selected->add($key)->toArray();

        $this->selected = $newSelection;

        $this->updateSession();
    }

    public function selectPage(bool $select): void
    {
        if (! $this->canSelect()) {
            return;
        }

        /** @var array<int, covariant Model> $items */
        $items = $this->paginate()->items();

        $page = collect($items)->map(function (Model $model): string {
            /** @var int|string $key */
            $key = $model->getKey();

            return (string) $key;
        });

        $selected = collect($this->selected);

        /** @var array<int, string> $newSelection */
        $newSelection = $select
            ? $selected->merge($page)->unique()->values()->toArray()
            : $selected->diff($page)->values()->toArray();

        $this->selected = $newSelection;

        $this->updateSession();
    }

    public function selectTable(bool $select): void
    {
        if (! $this->canSelect()) {
            return;
        }

        $table = $this->appliedQuery()->get()->map(function (Model $model): string {
            /** @var int|string $key */
            $key = $model->getKey();

            return (string) $key;
        });

        $selected = collect($this->selected);

        /** @var array<int, string> $newSelection */
        $newSelection = $select
            ? $selected->merge($table)->unique()->values()->toArray()
            : $selected->diff($table)->values()->toArray();

        $this->selected = $newSelection;
        $this->selectedPage = false;

        $this->updateSession();
    }

    protected function canSelect(): bool
    {
        $hasActions = $this->resolveActions()->standalone(false)->isNotEmpty();

        return $hasActions && ! $this->isReordering();
    }
}
