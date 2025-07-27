<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Columns;

class ActionColumn extends BaseColumn
{
    protected string $view = 'livewire-table::columns.content.action';

    protected bool $header = false;

    protected bool $computed = true;

    protected bool $clickable = false;
}
