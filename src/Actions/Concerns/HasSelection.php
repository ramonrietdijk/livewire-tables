<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Actions\Concerns;

trait HasSelection
{
    protected bool $clearSelection = true;

    public function clearSelection(bool $clearSelection = true): static
    {
        $this->clearSelection = $clearSelection;

        return $this;
    }

    public function keepSelection(): static
    {
        return $this->clearSelection(false);
    }

    public function shouldClearSelection(): bool
    {
        return $this->clearSelection;
    }
}
