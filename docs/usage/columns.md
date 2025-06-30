# Columns

To display your records you need to add columns to your table. You can specify what field to display - including
relationships. It is also possible to search and sort these columns if you choose to. There is also a variety of
different column types to make searching work out of the box.

Columns can be registered in the `columns` method of your Livewire Table.

```php
protected function columns(): array
{
    return [
        //
    ];
}
```

## Column Types

Currently, there are 6 different column types available.

### Column

The `Column` is the generic column type for most use cases. This column type is primarily meant for text like a name or
email address.

```php
Column::make(__('Name'), 'name'),
```

### Boolean Column

Booleans can be displayed using the `BooleanColumn`. This column will render a circle to display the current state.

```php
BooleanColumn::make(__('Published'), 'published'),
```

### Date Column

If you are working with dates, a `DateColumn` should be used. You can also supply a format using the `format` method.

```php
DateColumn::make(__('Created At'), 'created_at')
    ->format('d m Y'),
```

### Select Column

When a column can only accept a list of values, you may be interested in the `SelectColumn`. With this column you can
specify the options that can be used. If the field is searchable, you will get a dropdown of options to choose from.

```php
SelectColumn::make(__('Favorite Fruit'), 'favorite_fruit')
    ->options([
        'Apple' => 'Apple',
        'Banana' => 'Banana',
        'Pear' => 'Pear',
    ]),
```

You can also use a nested array in order to make use of option groups. Note that only one level of nesting is supported.

```php
SelectColumn::make(__('Favorite Fruit'), 'favorite_fruit')
    ->options([
        'Red Fruit' => [
            'Apple' => 'Apple',
            'Strawberry' => 'Strawberry',
        ],
        'Yellow Fruit' => [
            'Banana' => 'Banana',
        ],
        'Green Fruit' => [
            'Pear' => 'Pear',
        ],
    ]),
```

### Image Column

Images can easily be displayed using the `ImageColumn`. The value of the field will be the `src` of the image. It is also
possible to ajust the size of the image by using the `size` method or the `width` and `height` methods individually.

By default, the width and height of images are `32` pixels.

```php
ImageColumn::make(__('Thumbnail'), 'thumbnail')
    ->size(75, 75),

ImageColumn::make(__('Banner'), 'banner')
    ->width(100)
    ->height(50),
```

Image columns will disable the title of the column to preserve space. It can be enabled back using the `header`
method. See the [header](#header) section for more information.

### View Column

Although columns have an option to display their values [as HTML](#as-html), having a lot of
markup in your column can be a bit messy.

With a `ViewColumn` you can reference a view to load as the second argument.

::: info
The model will be passed to the view.
:::

```php
ViewColumn::make(__('Actions'), 'actions'),
```

If you've added links in your view, you should disable the column from being [clicked](#clickable).

```php
ViewColumn::make(__('Actions'), 'actions')
    ->clickable(false),
```

By default, only the model will be passed to the view. Any additional data can be passed by using the `with` method.

```php
ViewColumn::make(__('Actions'), 'actions')
    ->with([
        'key' => 'value',
    ]),

// or

ViewColumn::make(__('Actions'), 'actions')
    ->with('key', 'value'),
```

Just like any other column, the [header](#header) can be disabled as well.

## JSON

Data can also be accessed from a JSON column.

```php
Column::make(__('Color'), 'settings->color'),
```

## Searchable

To quickly find the records you need, you can make your columns searchable. By default, searching is not enabled for any
column, but it can easily be enabled.

```php
Column::make(__('Name'), 'name')
    ->searchable(),
```

It is also possible to pass a callback in order to handle searching yourself.

```php
use Illuminate\Database\Eloquent\Builder;
use RamonRietdijk\LivewireTables\Enums\SearchScope;

Column::make(__('Name'), 'name')
    ->searchable(function (Builder $builder, mixed $search, SearchScope $scope): void {
        //
    }),
```

The third parameter `$scope` can be either `SearchScope::Global` or `SearchScope::Column`. This can be helpful if you wish to process the search differently if it's passed by the global search or the column.

## Sortable

Records can be sorted by clicking on the title of the column. Just like searching, sorting is not enabled by default.

```php
Column::make(__('Name'), 'name')
    ->sortable(),
```

To set the default sort column and direction, use the `$sortColumn` and `$sortDirection` properties of your table.

```php
public string $sortColumn = 'name';

public string $sortDirection = 'asc';
```

You can also handle sorting yourself by passing a callback.

```php
use Illuminate\Database\Eloquent\Builder;
use RamonRietdijk\LivewireTables\Enums\Direction;

Column::make(__('Name'), 'name')
    ->sortable(function (Builder $builder, Direction $direction): void {
        //
    }),
```

## Visibility

All columns are visible in the table by default. It is possible to hide columns by calling the `hide` method. In that case, they will only be shown when they are enabled via the dropdown.

```php
Column::make(__('Name'), 'name')
    ->hide(),
```

## Authorization

By default, all columns will be available. You can disable access to a column by using the `canSee` method. You'll be able to supply a boolean or callback if the conditions are more complex.

```php
Column::make(__('Name'), 'name')
    ->canSee(fn (): bool => auth()->user()->can('...')),
```

## Relations

If you wish to show data from a related model, you can prefix the column with the name of the relations. Always use the name of the relations and not of the tables.

```php
Column::make(__('Company'), 'author.company.name'),
```

You can also use relations with a cardinality greater than one. The values will automatically be joined with a comma.

```php
Column::make(__('Tags'), 'tags.name'),
```

Head to [relations](/advanced/relations) to know more about relations and how they work behind the scenes.

## Display Using

Sometimes you wish to format the data in your table differently from how it's saved in the database. Luckily, this is
easily done using the method `displayUsing` on your column.

::: info
This will work for any column and **always** takes priority over a format.
:::

```php
Column::make(__('Name'), 'name')
    ->displayUsing(function (mixed $value, Model $model): string {
        return ucfirst($value);
    }),
```

## Clickable

All table cells can be clicked on by default. This will select the row or open the configured [link](/usage/links). This can be disabled by calling `clickable(false)` on the column.

::: info
If the column can't be clicked, you'll be able to select the content of the cell.
:::

```php
Column::make(__('Name'), 'name')
    ->clickable(false),
```

## Computed

In some cases you wish to display values which aren't stored in the database but are rather calculated like the
aggregate function `COUNT(*)`. This can be the total amount of blogs written by a user, for example.

If you pass a callback as the second argument to a column, it will mark the column as computed. The callback is the same
as `displayUsing`, documented above.

::: info
Computed columns **can't** be searched or sorted unless you have supplied a callback.
:::

::: warning
In the example below the column will calculate the amount of blogs for each user individually, introducing the N+1
problem. This can easily be overcome to keep the table efficient. Please see [efficiency](/advanced/efficiency) to see
the best practices.
:::

```php
Column::make(__('Total Blogs'), function (mixed $value, Model $model): int {
    return $model->author->blogs()->count();
}),
```

You can also manually mark a column as computed.

```php
Column::make(__('Name'), 'name')
    ->computed(),
```

## Header

Sometimes, displaying the title of the column in the header is not required. It can preserve space when showing a
thumbnail, for example.

Luckily, this is easily done by using the `header` method. If `false` is passed as the first argument, the header
will not be rendered in the table. The title of the column will always be visible in the column selection.

```php
Column::make(__('Name'), 'name')
    ->header(false),
```

## Footer

To display information in the footer of the column, you can use the `footer` method. Pass a callback to this method
and the contents will be rendered on the table.

The content in the footer will **not** be escaped in the table.

```php
Column::make(__('Name'), 'name')
    ->footer(function (): string {
        return "Where there's a will, there's a way";
    }),
```

## As HTML

::: warning
Always be cautious when using `asHtml()` as this may introduce XSS vulnerabilities.
:::

You can also choose to render the content of the column directly without any escaping.

```php
Column::make(__('Badge'), function (mixed $value, Model $model): string {
    return '<div>...</div>';
})->asHtml(),
```

It's recommended to use a [View](#view-column) column if you have a lot of markup.
