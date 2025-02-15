<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

trait CanBeMultiple
{
    protected bool $multiple = false;

    public function multiple(bool $multiple = true): static
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function isMultiple(): bool
    {
        return $this->multiple;
    }
}
