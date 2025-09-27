<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Actions\Concerns;

use RamonRietdijk\LivewireTables\Enums\ActionKind;

trait HasKind
{
    protected ActionKind $kind = ActionKind::Callback;

    public function isKind(ActionKind $kind): bool
    {
        return $this->kind === $kind;
    }

    public function isCallback(): bool
    {
        return $this->isKind(ActionKind::Callback);
    }

    public function isScript(): bool
    {
        return $this->isKind(ActionKind::Script);
    }
}
