# Selection

The selection of records in the table is enabled when non-standalone [actions](/usage/actions) have been added. However, it will be disabled during [reordering](/usage/reordering).

To permanently disable the selection, you can set the property `$useSelection` to false. Note that this property was introduced before the action logic stated above. This property will therefore be removed in the next major release.

```php
protected bool $useSelection = false;
```

If the selection state is more complex, the `canSelect` method can be overridden.

```php
protected function canSelect(): bool
{
    // ...

    return false;
}
```
