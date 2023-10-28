# Session

Instead of using the [query string](/configuration/query-string), the table can also save its current configuration into a session.

:::info
It is recommended to either use a query string or a session. Using them both at the same time may cause issues.
:::

Sessions can be enabled by setting the `$useSession` property to `true`.

```php
protected bool $useSession = true;
```

By default, only the selected columns are saved within the session. The `$sessionProperties` property contains a list of all properties that will be saved to the session. By adding `globalSearch` to the list, for example, the global search will also be saved in the session.

```php
protected array $sessionProperties = [
    'columns',
    'globalSearch',
];
```
