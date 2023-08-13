# Polling

When records are updated frequently, it may be useful to automatically refresh the table.

By default, polling is disabled. It can easily be enabled by adding polling options to your Livewire Table.

```php
protected array $pollingOptions = [
    '' => 'None',
    '10s' => 'Every 10 seconds',
];
```
