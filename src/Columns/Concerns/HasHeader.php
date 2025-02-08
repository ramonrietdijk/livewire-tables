<?php

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

/**
 * @property view-string $headerView
 */
trait HasHeader
{
    protected string $headerView = 'livewire-table::columns.header.default';

    protected bool $header = true;

    public function header(bool $header = true): static
    {
        $this->header = $header;

        return $this;
    }

    public function hasHeader(): bool
    {
        return $this->header;
    }

    public function renderHeader(): mixed
    {
        if (! $this->hasHeader()) {
            return '';
        }

        return view($this->headerView, ['column' => $this]);
    }
}
