<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

trait HasIdentifier
{
    protected function identifier(): string
    {
        return static::class;
    }
}
