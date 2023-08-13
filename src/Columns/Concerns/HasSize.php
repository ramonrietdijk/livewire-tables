<?php

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

trait HasSize
{
    protected int $width = 32;

    protected int $height = 32;

    public function size(int $width, int $height): static
    {
        $this->width = $width;
        $this->height = $height;

        return $this;
    }

    public function width(int $width): static
    {
        $this->width = $width;

        return $this;
    }

    public function height(int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
