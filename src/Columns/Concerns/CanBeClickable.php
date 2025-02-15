<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

trait CanBeClickable
{
    protected bool $clickable = true;

    public function clickable(bool $clickable = true): static
    {
        $this->clickable = $clickable;

        return $this;
    }

    public function isClickable(): bool
    {
        return $this->clickable;
    }
}
