<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasSelection
{
    /** @var array<int, string> */
    public array $selected = [];

    public bool $selectedPage = false;

    public function clearSelection(): void
    {
        $this->selected = [];
        $this->selectedPage = false;
    }

    public function updatingSelectedPage(bool $selectedPage): void
    {
        $this->selectPage($selectedPage);
    }

    public function selectItem(string $key): void
    {
        $selected = collect($this->selected);

        /** @var array<int, string> $newSelection */
        $newSelection = $selected->contains($key)
            ? $selected->diff([$key])->values()->toArray()
            : $selected->add($key)->toArray();

        $this->selected = $newSelection;
    }

    public function selectPage(bool $select): void
    {
        /** @var array<int, Model> $items */
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
    }

    public function selectTable(bool $select): void
    {
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
    }
}
