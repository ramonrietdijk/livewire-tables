<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasReordering
{
    public bool $reordering = false;

    protected bool $useReordering = false;

    protected string $reorderingColumn = 'order';

    /** @return array<string, mixed> */
    protected function queryStringHasReordering(): array
    {
        if (! $this->useQueryString) {
            return [];
        }

        return [
            'reordering' => [
                'as' => $this->getQueryStringName('reordering'),
            ],
        ];
    }

    public function updatedReordering(): void
    {
        $this->selected = [];
        $this->selectedPage = false;
    }

    public function reorderItem(string $from, string $to, bool $above): void
    {
        if ($from === $to) {
            return;
        }

        /** @var Model $from */
        $from = $this->query()->findOrFail($from);

        /** @var Model $to */
        $to = $this->query()->findOrFail($to);

        $column = $this->reorderingColumn;

        /** @var int $currentOrder */
        $currentOrder = $from->getAttribute($column) ?? 0;

        /** @var int $toOrder */
        $toOrder = $to->getAttribute($column) ?? 0;

        $up = $toOrder > $currentOrder;

        if ($above && $up) {
            $newOrder = $toOrder - 1;
        } elseif (! $above && ! $up) {
            $newOrder = $toOrder + 1;
        } else {
            $newOrder = $toOrder;
        }

        if ($newOrder === $currentOrder) {
            return;
        }

        if ($up) {
            // The new order is higher, meaning that everything between has to go down by one.
            $this
                ->query()
                ->where($column, '>', $currentOrder)
                ->where($column, '<=', $newOrder)
                ->decrement($column);
        } else {
            // The new order is lower, meaning that everything between has to go up by one.
            $this
                ->query()
                ->where($column, '<', $currentOrder)
                ->where($column, '>=', $newOrder)
                ->increment($column);
        }

        $from->setAttribute($column, $newOrder);
        $from->save();
    }

    protected function isReordering(): bool
    {
        return $this->useReordering && $this->reordering;
    }
}
