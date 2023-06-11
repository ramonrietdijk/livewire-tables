<?php

namespace RamonRietdijk\LivewireTables\Concerns;

trait HasInitialization
{
    public bool $initialized = false;

    public function init(): void
    {
        $this->initialized = true;
    }
}
