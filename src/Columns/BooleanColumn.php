<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Columns;

class BooleanColumn extends BaseColumn
{
    protected string $searchView = 'livewire-table::columns.search.boolean';

    protected string $view = 'livewire-table::columns.content.boolean';
}
