<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Actions\Concerns;

use RamonRietdijk\LivewireTables\Enums\ActionType;

trait HasType
{
    protected ActionType $type = ActionType::Bulk;

    public function type(ActionType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function isType(ActionType $type): bool
    {
        return $this->type === $type;
    }

    public function bulk(): static
    {
        return $this->type(ActionType::Bulk);
    }

    public function isBulk(): bool
    {
        return $this->isType(ActionType::Bulk);
    }

    public function standalone(): static
    {
        return $this->type(ActionType::Standalone);
    }

    public function isStandalone(): bool
    {
        return $this->isType(ActionType::Standalone);
    }

    public function record(): static
    {
        return $this->type(ActionType::Record);
    }

    public function isRecord(): bool
    {
        return $this->isType(ActionType::Record);
    }
}
