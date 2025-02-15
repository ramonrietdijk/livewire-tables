<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Livewire;

use RamonRietdijk\LivewireTables\Columns\BooleanColumn;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;

class SessionBlogLivewireTable extends LivewireTable
{
    protected string $model = Blog::class;

    protected bool $useSession = true;

    protected function columns(): array
    {
        return [
            Column::make(__('Title'), 'title'),

            BooleanColumn::make(__('Published'), 'published'),
        ];
    }
}
