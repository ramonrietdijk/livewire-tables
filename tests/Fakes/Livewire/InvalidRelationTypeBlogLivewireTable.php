<?php

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Livewire;

use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;

class InvalidRelationTypeBlogLivewireTable extends LivewireTable
{
    protected string $model = Blog::class;

    protected function columns(): array
    {
        return [
            Column::make(__('Blogs'), 'author.blogs.title'),
        ];
    }
}
