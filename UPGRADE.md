# Upgrade Guide

Guide to upgrade the package to the next major versions.

## Upgrading to 6.x from 5.x

The return type of methods `resolveActions`, `resolveColumns` and `resolveFilters` have been changed. They now return their own collection in favor of `Illuminate\Support\Collection` for easier interaction.

The event `refreshLivewireTable` has been removed. It was dispatched after the execution of actions which is redundant because the component already refreshes afterwards.

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
