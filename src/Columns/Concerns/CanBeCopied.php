<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

trait CanBeCopied
{
    protected bool $copyable = false;

    public function copyable(bool $copyable = true): static
    {
        $this->copyable = $copyable;

        return $this;
    }

    public function isCopyable(): bool
    {
        return $this->copyable;
    }
}
