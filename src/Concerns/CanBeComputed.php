<?php

namespace RamonRietdijk\LivewireTables\Concerns;

trait CanBeComputed
{
    protected bool $computed = false;

    public function computed(bool $computed = true): static
    {
        $this->computed = $computed;

        return $this;
    }

    public function isComputed(): bool
    {
        return $this->computed;
    }
}
