<?php

namespace RamonRietdijk\LivewireTables\Columns;

use RamonRietdijk\LivewireTables\Concerns\HasOptions;

class SelectColumn extends BaseColumn
{
    use HasOptions;

    protected string $searchView = 'livewire-table::columns.search.select';
}
