# Relations

Relations are supported in columns and filters. They allow easy access to related models to display or filter data.

::: info
Currently, only the `BelongsTo` relation is supported.
:::

The Livewire Table will search through every column and filter to see if a relation is defined. If so, it will
automatically eager load the (nested) relation. The value is resolved via the models themselves.

**Example:**

```php
// author.company.name

$blog->author->company->name;
```

This approach is used because of 2 reasons:

1. There is no need to individually select columns except for the main table.
2. Defined accessors and casts in Laravel are respected when displaying the value.

## Aliasing

In order to search, sort or add where-clauses we require the tables of our related models. Tables are automatically
left-joined to the dataset in order to perform these actions. Because some relations may refer to the same table, they
are automatically aliased including the relation name.

**Example:**

Column `author.company.name` has the relations `author` and `company` and the column of `name`. This example will create
2 aliases:

1. `author` for the `users` table
2. `author_company` for the `companies` table, joined on `users`

The column that will be used to search, sort or queried on will be `author_company.name`.
