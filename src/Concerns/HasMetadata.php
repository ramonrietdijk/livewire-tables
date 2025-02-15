<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

trait HasMetadata
{
    /** @var array<string, mixed> */
    protected array $metadata = [];

    public function setMeta(string $key, mixed $value): static
    {
        $this->metadata[$key] = $value;

        return $this;
    }

    public function getMeta(string $key, mixed $default = null): mixed
    {
        return $this->metadata[$key] ?? $default;
    }
}
