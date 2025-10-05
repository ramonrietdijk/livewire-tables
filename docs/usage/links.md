# Links

By default, clicking on a row will select it. Most times, you want to be redirected to the edit page of a model. You can
achieve this by overriding the `link` method of the Livewire Table.

```php
public function link(Model $model): ?string
{
    return route('model.edit', ['model' => $model]);
}
```

## Navigate

In order to make use of Livewire's [Navigate](https://livewire.laravel.com/docs/navigate), set the `$useNavigate` property to `true`.

```php
protected bool $useNavigate = true;
```

## Multiple links

If you wish to have multiple links, you could consider making a new column for this.

::: info
Make sure to call `clickable(false)` as this will prevent the default click action as described [here](/usage/columns#clickable).
:::

```php
Column::make(__('Links'), function (Model $model): string {
    return '<a class="underline" href="#">...</a>';
})
    ->clickable(false)
    ->asHtml(),
```
