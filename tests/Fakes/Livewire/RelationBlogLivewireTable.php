<?php

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Livewire;

use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;

class RelationBlogLivewireTable extends LivewireTable
{
    protected string $model = Blog::class;

    protected function columns(): array
    {
        return [
            Column::make(__('Title'), 'title')
                ->sortable()
                ->searchable(),

            Column::make(__('Category'), 'category.title')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),

            Column::make(__('Author'), 'author.uppercase'),

            Column::make(__('Company'), 'author.company.name')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),

            Column::make(__('Employees'), 'author.company.employees.name')
                ->sortable()
                ->searchable(),

            Column::make(__('Tags'), 'tags.name')
                ->sortable()
                ->searchable(),
        ];
    }
}
