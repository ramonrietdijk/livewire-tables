# Pagination

The pagination makes use of the `WithPagination` trait from [Livewire](https://livewire.laravel.com/docs/4.x/pagination).

## Passing data

You can use the `$paginationData` property in order to pass data to the paginator.

```php
protected array $paginationData = [
    //
];
```

## Scroll behavior

After navigating between pages, the paginator will automatically scroll to the top of the page. You can disable this behavior by setting `scrollTo` to `false`. Visit the documentation of [Livewire](https://livewire.laravel.com/docs/4.x/pagination#customizing-scroll-behavior) for more information.

```php
protected array $paginationData = [
    'scrollTo' => false,
];
```
