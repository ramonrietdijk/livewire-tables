# Efficiency

As stated in the introduction, this package has been built with simplicity and efficiency in mind. However, incorrect usage of the Livewire Table can still lead to massive performance penalties.

In most use cases, you should be totally fine. When you are using aggregate functions, please pay close attention.

## Aggregate functions

We are building a blog table where a blog belongs to an author. In this table, we would like to see the total amount of blogs written by the author.

```php
class BlogTable extends LivewireTable
{
    protected string $model = Blog::class;

    protected function columns(): array
    {
        return [
            Column::make(__('Title'), 'title'),

            Column::make(__('Author'), 'author.name'),

            Column::make(__('Total Blogs'), function (mixed $value, Model $model): int {
                return $model->author->blogs()->count();
            }),
        ];
    }
}
```

The example above will introduce an N+1 problem as every row is now individually counting the total amount of blogs for the author. This, of course, is a performance penalty, especially with greater datasets.

In this case, we could count the amount of blogs beforehand, preventing a lot of extra queries to the database. We can do this by overriding the `applySelect` method of our Livewire Table.

```php
use Illuminate\Database\Eloquent\Builder;

protected function applySelect(Builder $builder): static
{
    parent::applySelect($builder);

    $builder->selectRaw(
        '(SELECT COUNT(`blogs`.`author_id`) FROM `blogs` WHERE `blogs`.`author_id` = `author`.`id` GROUP BY `blogs`.`author_id`) AS total_blogs'
    );

    return $this;
}
```

Now that the count has been selected manually, we can update our column.

```php
Column::make(__('Total Blogs'), function (mixed $value, Model $model): int {
    return $model->total_blogs;
})
```

This time, it will not execute any additional queries as the value is retrieved from the query selection itself.

As described in [columns](/usage/columns#computed), computed columns can't be searched or sorted without a callback. This has to be added by yourself.

If we want the count to be searched and sorted, we could update our column once again.

```php
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as Query;

Column::make(__('Total Blogs'), function (mixed $value, Model $model): int {
    return $model->total_blogs;
})->sortable(function (Builder $builder, Direction $direction): void {
    $builder->orderBy(function (Query $query): void {
        $query->selectRaw('COUNT(*)')->from('blogs')->whereColumn('author_id', '=', 'author.id');
    }, $direction->value);
})->searchable(function (Builder $builder, mixed $value): void {
    $builder->where(function (Query $query): void {
        $query->selectRaw('COUNT(*)')->from('blogs')->whereColumn('author_id', '=', 'author.id');
    }, '=', $value);
}),
```
