<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Collections;

use RamonRietdijk\LivewireTables\Actions\BaseAction;

/**
 * @extends BaseCollection<int, BaseAction>
 */
class ActionCollection extends BaseCollection
{
    public function bulk(bool $bulk = true): static
    {
        return $this->filter(fn (BaseAction $action): bool => $action->isBulk() === $bulk);
    }

    public function standalone(bool $standalone = true): static
    {
        return $this->filter(fn (BaseAction $action): bool => $action->isStandalone() === $standalone);
    }

    public function record(bool $record = true): static
    {
        return $this->filter(fn (BaseAction $action): bool => $action->isRecord() === $record);
    }
}
