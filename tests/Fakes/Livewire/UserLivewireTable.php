<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Livewire;

use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;

class UserLivewireTable extends LivewireTable
{
    protected string $model = User::class;

    protected function columns(): array
    {
        return [
            Column::make(__('Name'), 'name'),
        ];
    }
}
