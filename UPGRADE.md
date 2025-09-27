# Upgrade Guide

Guide to upgrade the package to the next major versions.

## Upgrading to 6.x from 5.x

Documentation about the [versioning](VERSIONING.md) of this package has been added. Please, read it carefully before upgrading.

The changes in this release have been categorized into `High`, `Medium` and `Low` impact.

### High

#### Action constructor

The constructor for actions has been changed for more flexibility. The callback has been moved to the second parameter. The third parameter has become an optional code to identify the action. The new structure is more aligned with columns and filters.

For JavaScript actions, no changes are required. In the case of callbacks, removing the second argument is all that is needed.

```php
Action::make(__('Publish'), function (Collection $models): void {
    //
}),
```

If you've exported the views of this package, make sure to update them as well. The JavaScript can be received from the method `script()` instead of `code()`.

```html
<button ...
    x-on:click="
        {{ $action->script() }}
        show = false
    "
>
    ...
</button>
```

### Medium

#### Selection

The selection of records will automatically be cleared after an action has been executed. Returning `false` won't prevent this anymore. Make use of the `keepSelection` method instead.

### Low

#### New collections

The return type of methods `resolveActions`, `resolveColumns` and `resolveFilters` have been changed. They now return their own collection in favor of `Illuminate\Support\Collection` for easier interaction.

#### Dropped event

The event `refreshLivewireTable` has been removed. It was dispatched after the execution of actions which is redundant because the component already refreshes afterwards.

#### Eloquent collection

The type of parameter `$models` in method `execute` of the `BaseAction` has been changed from `Illuminate\Support\Enumerable` to `Illuminate\Database\Eloquent\Collection`. As `Illuminate\Database\Eloquent\Collection` implements the `Illuminate\Support\Enumerable` interface, application code does not have to be updated.

#### Standalone

A new `Record` action type has been added. Due to this, the trait `CanBeStandalone` has been removed from the `BaseAction` class in favor of the `HasType` trait. The methods `standalone` and `isStandalone` are still available. Please note that the `standalone` method does not accept a boolean anymore. In the case of `false`, use the method `bulk` instead or omit it entirely.

## Upgrading to 5.x from 4.x

Laravel 12 is supported since version 5.x. Support for Laravel 11 and PHP version 8.2 have both been dropped.

The property `$useSelection` has been removed from the `HasSelection` trait as the selection will automatically be disabled when no actions have been added.

The signature of methods `search` and `applySearch` in the `HasSearch` trait of columns has been changed. It now has a `SearchScope` as the second parameter. The callback for `searchable` on columns has not been changed. Access to the scope is given via the third parameter of your callback.

The default implementation of searching explicitly checks if the input is a string now.

All views have been updated to support Tailwind 4.

## Upgrading to 4.x from 3.x

Laravel 11 is supported since version 4.x. Support for Laravel 10 and PHP version 8.1 have both been dropped.

The `mount` method has been renamed to `mountHasInitialization` and is moved to the `HasInitialization` concern. If you are overriding the `mount` method, make sure to remove `parent::mount()` as it's no longer available.

The `$key` parameter of methods `updatedFilters` and `updatedSearch` have been made nullable. If you are overriding these methods, make sure to update the method signature.

## Upgrading to 3.x from 2.x

Support for Livewire 3 has been introduced in version 3.x.

To be consistent with the default configuration of Livewire 3, the Livewire Table has been moved outside the `Http` namespace.

Please, update all references to this class with the new namespace.

```php
use RamonRietdijk\LivewireTables\Http\Livewire\LivewireTable;

// Should be replaced with

use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
```

## Upgrading to 2.x from 1.x

In version 2.x of this package the dependency of `blade-ui-kit/blade-heroicons` has been dropped. All icons are now displayed using the SVG directly. If you have published the views of this package you should either update all icons to SVG instead of the blade component or install `blade-ui-kit/blade-heroicons` again manually.
