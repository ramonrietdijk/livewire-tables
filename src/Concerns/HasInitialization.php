<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use RamonRietdijk\LivewireTables\Columns\BaseColumn;

trait HasInitialization
{
    public bool $initialized = false;

    public function init(): void
    {
        $this->initialized = true;
    }

    public function mountHasInitialization(): void
    {
        $this->initialize();
    }

    protected function initialize(): void
    {
        $this->restoreSession();

        if (count($this->columns) === 0) {
            /** @var array<int, string> $columns */
            $columns = $this->resolveColumns()
                ->filter(fn (BaseColumn $column): bool => $column->isVisible())
                ->map(fn (BaseColumn $column): string => $column->code())
                ->values()
                ->toArray();

            $this->columns = $columns;
        }
    }
}
