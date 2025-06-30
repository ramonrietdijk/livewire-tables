<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

use Closure;

trait CanBeSeen
{
    protected bool|Closure $canSee = true;

    public function canSee(bool|Closure $canSee = true): static
    {
        $this->canSee = $canSee;

        return $this;
    }

    public function canBeSeen(): bool
    {
        if (is_bool($this->canSee)) {
            return $this->canSee;
        }

        return call_user_func($this->canSee);
    }
}
