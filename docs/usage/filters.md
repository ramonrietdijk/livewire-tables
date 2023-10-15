# Filters

Filters are a very simple way to quickly show the records that you are looking for.

They can be registered in the `filters` method of your Livewire Table.

```php
protected function filters(): array
{
    return [
        //
    ];
}
```

## Filter Types

Currently, there are 3 different filter types available.

### Boolean Filter

Booleans can be filtered using the `BooleanFilter`.

```php
BooleanFilter::make(__('Published'), 'published'),
```

### Date Filter

If you are working with dates, a `DateFilter` should be used. This filter will give you a `from` and `to` date to filter
your records with.

```php
DateFilter::make(__('Created At'), 'created_at'),
```

### Select Filter

When a filter can only accept a list of values, you may be interested in the `SelectFilter`. With this filter you can
specify the options that can be used. You will get a dropdown of options to choose from to filter your records.

```php
SelectFilter::make(__('Category'), 'category_id')
    ->options([
        1 => 'PHP',
        2 => 'Laravel',
        3 => 'Tailwind CSS',
    ]),
```

By calling the `multiple` method on the filter, it will accept multiple values at a time.

```php
SelectFilter::make(__('Category'), 'category_id')
    ->multiple(),
```

## Relations

If you wish to filter data from a related model, you can prefix the column with the name of the relations. Always use
the name of the relations and not of the tables.

::: info
Currently, only the `BelongsTo` relation is supported.
:::

```php
BooleanFilter::make(__('Active Author'), 'author.active'),
```

Head to [relations](/advanced/relations) to know more about how relations work behind the scenes.

## Custom Filtering

In some cases, the filter you are building is not related to a single column in your database. It could be a composition
of multiple conditions. If you pass a callback as the second argument to a filter you can query the data yourself.

::: info
Filters are always executed even if the value is null to allow for a default filter. Please, check the `$value`
yourself in your callback.
:::

```php
BooleanFilter::make(__('Recent Blogs'), function (Builder $builder, mixed $value): void {
    $builder->when($value, function (Builder $builder) use ($value): void {
        $builder
            ->where('published', '=', true)
            ->whereDate('created_at', '>=', now()->subWeek());
    });
}),
```
