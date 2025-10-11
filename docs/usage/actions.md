# Actions

Actions can be defined on your table to perform certain tasks on the selected records. They can be registered in the `actions` method of your Livewire Table.

```php
protected function actions(): array
{
    return [
        //
    ];
}
```

To create an action, simply add a label and callback.

```php
Action::make(__('Publish'), function (Collection $models): void {
    //
}),
```

Actions can return anything but are not required to. This makes it very simple to redirect the user to another page or to download an [export](/usage/exports) of the records.

## Types

There is a total of 3 types an action can be:

1. Bulk
2. Standalone
3. Record

### Bulk

Type `Bulk` is the default type for actions. It will indicate that the action can interact with multiple records at a time.

::: info
Note that the `bulk` method is added explicitly for demonstration purposes only.
:::

```php
Action::make(__('Publish'), function (Collection $models): void {
    //
})->bulk(),
```

### Standalone

The `Standalone` type is meant for actions that do not require a selection of records.

::: info
The collection of `$models` is always empty if a standalone action is executed so it can be omitted.
:::

```php
Action::make(__('Import'), function (): void {
    //
})->standalone(),
```

### Record

At last, the `Record` type can be used to indicate that the action is only meant for a single record at a time.

::: info
Note that the collection of `$models` will always contain one model.
:::

```php
Action::make(__('Publish'), function (Collection $models): void {
    //
})->record(),
```

## Selection

When an action has been executed, it will automatically clear the selection. This can be prevented by calling the `keepSelection` method on your action.

```php
Action::make(__('Publish'), function (Collection $models): void {
    //
})->keepSelection(),
```

If you wish to clear the selection conditionally, you can call the `clearSelection` method on your Livewire Table.

```php
Action::make(__('Publish'), function (Collection $models): void {
    //

    $this->clearSelection();
})->keepSelection(),
```

## JavaScript

Some actions may only require the execution of JavaScript, like triggering a modal for example. In these cases, there is no point in sending a request to Livewire. If a callback is not supplied to an action, it will be treated like a JavaScript action. You'll have access to the [$wire](https://livewire.laravel.com/docs/javascript#the-wire-object) property.

::: info
JavaScript actions work for both normal and standalone actions.
:::

```php
Action::make(__('JavaScript'), <<<JS
    console.log('I\'ve been executed!');
JS)->standalone(),
```

You'll also have access to the `selected` property which contains all the selected records.

```php
Action::make(__('JavaScript'), <<<JS
    console.log('You have selected ' + selected.length + ' record(s)');
JS),
```

## Authorization

By default, all actions will be available. You can manage the access to an action by using the `canSee` method.

```php
Action::make(__('Publish'), function (Collection $models): void {
    //
})->canSee(auth()->user()->can('...')),
```

You can make use of the `canRun` method to specify if the action can be run for the given model. Note that this method does not apply to [standalone actions](#standalone) as they do not interact with models directly.

```php
Action::make(__('Publish'), function (Collection $models): void {
    //
})->canRun(function (Model $model): bool {
    return true;
}),
```
