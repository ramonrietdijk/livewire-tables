<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

trait Makeable
{
    public static function make(mixed ...$arguments): static
    {
        /** @phpstan-ignore-next-line */
        return new static(...$arguments);
    }
}
