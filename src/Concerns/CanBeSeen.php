<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

trait CanBeSeen
{
    protected bool $canSee = true;

    public function canSee(bool $canSee = true): static
    {
        $this->canSee = $canSee;

        return $this;
    }

    public function canBeSeen(): bool
    {
        return $this->canSee;
    }
}
