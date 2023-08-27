<?php

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

trait HasFormat
{
    protected ?string $format = null;

    public function format(string $format = null): static
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }
}
