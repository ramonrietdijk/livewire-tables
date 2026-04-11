<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Actions\Concerns;

use RamonRietdijk\LivewireTables\Enums\ActionVariant;

trait HasVariant
{
    protected ActionVariant $variant = ActionVariant::Info;

    public function variant(ActionVariant $variant): static
    {
        $this->variant = $variant;

        return $this;
    }

    public function isVariant(ActionVariant $variant): bool
    {
        return $this->variant === $variant;
    }

    public function info(): static
    {
        return $this->variant(ActionVariant::Info);
    }

    public function isInfo(): bool
    {
        return $this->isVariant(ActionVariant::Info);
    }

    public function danger(): static
    {
        return $this->variant(ActionVariant::Danger);
    }

    public function isDanger(): bool
    {
        return $this->isVariant(ActionVariant::Danger);
    }

    public function getVariant(): ActionVariant
    {
        return $this->variant;
    }
}
