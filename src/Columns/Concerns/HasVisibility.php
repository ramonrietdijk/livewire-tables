<?php

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

trait HasVisibility
{
    protected bool $visible = true;

    public function visible(bool $visible = true): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function hide(): static
    {
        return $this->visible(false);
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }
}
