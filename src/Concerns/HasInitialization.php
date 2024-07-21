<?php

namespace RamonRietdijk\LivewireTables\Concerns;

trait HasInitialization
{
    public bool $initialized = false;

    public function init(): void
    {
        $this->initialized = true;
    }

    public function mountHasInitialization(): void
    {
        $this->initialize();
    }

    protected function initialize(): void
    {
        $this->restoreSession();

        $this->initializeColumns();
    }
}
