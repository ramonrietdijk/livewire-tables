<?php

namespace RamonRietdijk\LivewireTables\Columns;

use RamonRietdijk\LivewireTables\Columns\Concerns\HasSize;

class ImageColumn extends BaseColumn
{
    use HasSize;

    protected string $view = 'livewire-table::columns.content.image';

    protected bool $header = false;
}
