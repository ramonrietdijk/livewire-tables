<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

trait HasOptions
{
    /** @var array<mixed, mixed> */
    protected array $options = [];

    /** @param  array<mixed, mixed>  $options */
    public function options(array $options = []): static
    {
        $this->options = $options;

        return $this;
    }

    /** @return array<mixed, mixed> */
    public function getOptions(): array
    {
        return $this->options;
    }
}
