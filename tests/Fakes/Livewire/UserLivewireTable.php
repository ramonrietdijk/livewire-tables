<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Livewire;

use Override;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;

class UserLivewireTable extends LivewireTable
{
    protected string $model = User::class;

    #[Override]
    protected function columns(): array
    {
        return [
            Column::make(__('Name'), 'name'),
        ];
    }
}
