<?php

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

trait HasData
{
    /** @var array<string, mixed> */
    protected array $data = [];

    /** @param  string|array<string, mixed>  $key */
    public function with(string|array $key, mixed $value = null): static
    {
        if (is_array($key)) {
            $this->data = $key;
        } else {
            $this->data[$key] = $value;
        }

        return $this;
    }
}
