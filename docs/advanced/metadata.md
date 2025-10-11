# Metadata

Metadata is data that can be added to your actions, columns and filters as a key-value pair.

```php
Column::make(__('Name'), 'name')
    ->setMeta('key', 'value'),
```

This functionality is not used by the package itself and is exclusively for customizing the views. The metadata can be accessed in the views via the `getMeta` method.
