# Selection

The selection of records in the table are enabled by default. This behaviour can be disabled by setting the property to false.

::: info
The selection could be disabled automatically when no regular actions are available. This is not implemented to preserve performance as much as possible.
:::

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

Out of the box, the selection is always enabled, depending on the value of the `$useSelection` property. The selection will get disabled during [reordering](/usage/reordering). Make sure to pay attention to this when overriding the method.
