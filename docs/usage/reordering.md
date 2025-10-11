# Reordering

Reordering records in the table can be implemented if your model has an order column to save its position.

::: info
If you have enabled reordering and no sorting is set by the user, the table will automatically sort its records using the order column. You don't need an additional column for this.
:::

By default, reordering records is disabled. It can be enabled by adding the following property to your class:

```php
protected bool $useReordering = true;
```

It will use the column with the name of `order` by default but it can be overwitten like so:

```php
protected string $reorderingColumn = 'position';
```

If the reordering functionality has been enabled, a new button will show up. When reordering, the button will be activated and the rows in the table can be dragged and dropped.
