# Defer Loading

If the query to fetch your data takes a while, it will delay the page from loading. By default, deferred loading is not enabled.

By enabling this feature the records will be fetched after the page has finished loading.

```php
protected bool $deferLoading = true;
```
