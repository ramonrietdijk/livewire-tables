# Soft Deletes

Livewire Tables supports soft deletes out of the box. If your model has the `SoftDeletes` trait, it will automatically add a section to the configuration dropdown. With this section, you will be able to:

1. See records that have not been trashed (default)
2. See all records, including trashed
3. Only see trashed records

If your model has the `SoftDeletes` trait, but you do not want the functionalities that come with it, you can disable it by overriding the `hasSoftDeletes` method in your Livewire Table.

```php
protected function hasSoftDeletes(): bool
{
    return false;
}
```
