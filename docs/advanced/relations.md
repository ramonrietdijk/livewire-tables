# Relations

Relations are supported by both columns and filters. They allow easy access to related models to display or filter data.

The Livewire Table will search through every column and filter to see if a relation is defined. If so, it will automatically eager load the (nested) relation. The value that is displayed in the table is resolved via the models themselves, not with a seperate selection.

This approach is used because of 2 reasons:

1. There is no need to individually select any columns except for the main table.
2. Defined accessors and casts in Laravel are respected when displaying the value.

## Relation Types

All eloquent relations should work out of the box and can be used in the table.

A `BelongsTo` relationship is automatically left joined to the table. As these relationships have a cardinality of one or zero, it will not show duplicate records or require a group by statement. By doing so, columns that are referencing this relationship can automatically be sorted by if you enable [sorting](/usage/columns#sortable) for these columns.

All relations will query the data based on [the existence](https://laravel.com/docs/master/eloquent-relationships#querying-relationship-existence) of the relationship. This way, all types of eloquent relations can be used.

As a `BelongsTo` relationship has already been joined by the table, it can be more performant to add `qualifyUsingAlias()` to any `BelongsTo` columns. This will internally add a `where` clause to the joined table instead of a subquery as described above.

Displaying data from a x-to-many relationship is also possible. If a column of `tags.name` is referenced, the Livewire Table will get the `name` of all associated `tags`. These values will then joined by a comma.

Note that for very specific use cases you can always make use of [computed](/usage/columns#computed) columns.

## Examples

For columns:

```php
Column::make(__('Company'), 'author.company.name')
    ->qualifyUsingAlias()
    ->sortable()
    ->searchable(),

Column::make(__('Tags'), 'tags.name')
    ->searchable(),
```

For filters:

```php
BooleanFilter::make(__('Active Author'), 'author.active')
    ->qualifyUsingAlias(),

SelectFilter::make(__('Tags'), 'tags.id')
    ->options(
        Tag::query()->pluck('name', 'id')->toArray()
    ),
```

## Behind The Scenes

:::info
This currently only applies to a `BelongsTo` relationship.
:::

In order to automatically make sorting available on relationships, the tables of the related models are required. Tables from a `BelongsTo` relationship are automatically left joined to the dataset. Because some relations may refer to the same table, they are automatically aliased including the name of the relation. A blog could have an "author" and "editor" which reference the same "users" table.

**Example:**

Column `author.company.name` has the relations `author` and `company` and the column of `name`. This example will create 2 aliases:

1. `author` for the `users` table
2. `author_company` for the `companies` table, joined on `users`

The column that will be used to sort on will be `author_company.name`.
