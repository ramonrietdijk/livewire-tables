<?php

namespace RamonRietdijk\LivewireTables\Concerns;

trait HasIdentifier
{
    protected function identifier(): string
    {
        return static::class;
    }
}
