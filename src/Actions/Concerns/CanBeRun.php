<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Actions\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Model;

trait CanBeRun
{
    protected ?Closure $canRun = null;

    public function canRun(?Closure $canRun = null): static
    {
        $this->canRun = $canRun;

        return $this;
    }

    public function canRunCallback(): ?Closure
    {
        return $this->canRun;
    }

    public function canBeRun(Model $model): bool
    {
        if (($callback = $this->canRunCallback()) !== null) {
            return call_user_func($callback, $model);
        }

        return true;
    }
}
