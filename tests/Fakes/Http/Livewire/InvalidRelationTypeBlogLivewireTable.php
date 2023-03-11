<?php

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Http\Livewire;

use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Http\Livewire\LivewireTable;
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
