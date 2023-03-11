<?php

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

trait HasHeader
{
    protected string $headerView = 'livewire-table::columns.header.default';

    public function renderHeader(): mixed
    {
        return view($this->headerView, ['column' => $this]);
    }
}
