<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

trait CanBeRaw
{
    protected bool $raw = false;

    public function asHtml(bool $raw = true): static
    {
        $this->raw = $raw;

        return $this;
    }

    public function isRaw(): bool
    {
        return $this->raw;
    }
}
