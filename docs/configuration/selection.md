# Selection

The selection of records in the table is enabled when non-standalone [actions](/usage/actions) have been added. However, it will be disabled during [reordering](/usage/reordering).

If the selection state is more complex, the `canSelect` method can be overridden.

```php
protected function canSelect(): bool
{
    // ...

    return false;
}
```
