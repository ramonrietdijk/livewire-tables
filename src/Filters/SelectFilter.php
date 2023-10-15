<?php

namespace RamonRietdijk\LivewireTables\Filters;

use RamonRietdijk\LivewireTables\Concerns\CanBeMultiple;
use RamonRietdijk\LivewireTables\Concerns\HasOptions;

class SelectFilter extends BaseFilter
{
    use CanBeMultiple;
    use HasOptions;

    protected string $view = 'livewire-table::filters.select';
}
