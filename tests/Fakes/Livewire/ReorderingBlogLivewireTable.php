<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Override;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;

class ReorderingBlogLivewireTable extends LivewireTable
{
    protected string $model = Blog::class;

    protected bool $useReordering = true;

    #[Override]
    protected function columns(): array
    {
        return [
            Column::make(__('Title'), 'title')
                ->sortable()
                ->searchable(),
        ];
    }

    #[Override]
    protected function actions(): array
    {
        return [
            Action::make(__('Publish'), function (Collection $models): void {
                /** @var Blog $model */
                foreach ($models as $model) {
                    $model->published = true;
                    $model->save();
                }
            }),
        ];
    }
}
