# Actions

Actions can be defined on your table to perform certain tasks on the selected records. They can be registered in
the `actions` method of your Livewire Table.

```php
protected function actions(): array
{
    return [
        //
    ];
}
```

To create an action, simply add a label, code and callback.

```php
Action::make(__('My Action'), 'my_action', function (Enumerable $models): void {
    //
}),
```

Actions can return anything but are not required to. This makes it very simple to redirect the user to another page or to download an [export](/usage/exports) of the records.

When an action has been executed, it will automatically clear the selection and refresh the table. This can be prevented
if you return `false` from your callback.

## Standalone

Actions can also be standalone by calling `standalone()` on them. Not every action requires a selection of
records, e.g. starting an import.

::: info
Note that the collection of `$models` is always empty if a standalone action is executed.
:::

```php
Action::make(__('Import'), 'import', function (Enumerable $models): void {
    //
})->standalone(),
```

## JavaScript

Some actions may only require the execution of JavaScript, like triggering a modal for example. In these cases, there is no point in sending a request to Livewire. If a callback is not supplied to an action, it will be treated like a JavaScript action.

::: info
JavaScript actions work for both normal and standalone actions.
:::

```php
Action::make(__('JavaScript'), <<<JS
    console.log('I\'ve been executed!');
JS)->standalone(),
```

Within these actions, you have access to the [$wire](https://livewire.laravel.com/docs/javascript#the-wire-object) property. This means that you can also interact with the selected records in JavaScript.

```php
Action::make(__('JavaScript'), <<<JS
    console.log('You have selected ' + \$wire.selected.length + ' record(s)');
JS),
```

## Authorization

By default, all actions will be available. You can disable access to an action by using the `canSee` method. You'll be able to supply a boolean or callback if the conditions are more complex.

```php
Action::make(__('My Action'), 'my_action', function (Enumerable $models): void {
    //
})->canSee(fn (): bool => auth()->user()->can('...')),
```
