<?php

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Livewire;

use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;

class ReorderingBlogLivewireTable extends LivewireTable
{
    protected string $model = Blog::class;

    protected bool $useReordering = true;

    protected function columns(): array
    {
        return [
            Column::make(__('Title'), 'title')
                ->sortable()
                ->searchable(),
        ];
    }
}
