# Example

See the example below for a blog table with a relation to the category, author and company.

If you wish to see an example in action, open de [demo](https://livewire-tables.ramonrietdijk.nl)!

```php
<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Columns\ActionColumn;
use RamonRietdijk\LivewireTables\Columns\BooleanColumn;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Columns\DateColumn;
use RamonRietdijk\LivewireTables\Columns\ImageColumn;
use RamonRietdijk\LivewireTables\Columns\SelectColumn;
use RamonRietdijk\LivewireTables\Filters\BooleanFilter;
use RamonRietdijk\LivewireTables\Filters\DateFilter;
use RamonRietdijk\LivewireTables\Filters\SelectFilter;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;

class BlogTable extends LivewireTable
{
    protected string $model = Blog::class;

    protected function columns(): array
    {
        return [
            ImageColumn::make(__('Thumbnail'), 'thumbnail'),

            Column::make(__('Title'), 'title')
                ->sortable()
                ->searchable(),

            SelectColumn::make(__('Category'), 'category.title')
                ->options(
                    Category::query()->get()->pluck('title', 'title')->toArray()
                )
                ->sortable()
                ->searchable(),

            Column::make(__('Author'), 'author.name')
                ->sortable()
                ->searchable(),

            Column::make(__('Company'), 'author.company.name')
                ->sortable()
                ->searchable(),

            BooleanColumn::make(__('Published'), 'published')
                ->sortable(),

            DateColumn::make(__('Created At'), 'created_at')
                ->sortable()
                ->format('F jS, Y'),

            ActionColumn::make(__('Actions')),
        ];
    }

    protected function filters(): array
    {
        return [
            BooleanFilter::make(__('Published'), 'published'),

            SelectFilter::make(__('Category'), 'category_id')
                ->options(
                    Category::query()->pluck('title', 'id')->toArray()
                ),

            SelectFilter::make(__('Author'), 'author_id')
                ->options(
                    User::query()->pluck('name', 'id')->toArray()
                ),

            DateFilter::make(__('Created At'), 'created_at'),
        ];
    }

    protected function actions(): array
    {
        return [
            Action::make(__('Publish All'), function (): void {
                Blog::query()->update(['published' => true]);
            })->standalone(),

            Action::make(__('Publish'), function (Collection $models): void {
                foreach ($models as $model) {
                    $model->published = true;
                    $model->save();
                }
            })->canRun(fn (Blog $blog): bool => ! $blog->published),

            Action::make(__('Unpublish'), function (Collection $models): void {
                foreach ($models as $model) {
                    $model->published = false;
                    $model->save();
                }
            })->canRun(fn (Blog $blog): bool => $blog->published),

            Action::make(__('Delete'), function (Collection $models): void {
                foreach ($models as $model) {
                    $model->delete();
                }
            })
                ->canRun(fn (Blog $blog): bool => ! $blog->trashed())
                ->record(),

            Action::make(__('Restore'), function (Collection $models): void {
                foreach ($models as $model) {
                    $model->restore();
                }
            })
                ->canRun(fn (Blog $blog): bool => $blog->trashed())
                ->record(),
        ];
    }
}
```
