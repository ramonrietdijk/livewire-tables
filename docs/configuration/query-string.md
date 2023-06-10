# Query String

By default, your Livewire Table will make use of the query string. If you refresh the page, most of your settings will persist because of this.

## Prefix

If you have multiple instances on a page, you may want to add a query string prefix to your Livewire Table. This will prevent multiple tables from using the same data in the query string.

```php
protected string $queryStringPrefix = 'blog';
```

## Disable the query string

In some cases it is not desirable to make use of the query string at all. It can be disabled very easily.

```php
protected bool $useQueryString = false;
```
