# Upgrade Guide

Guide to upgrade the package to the next major versions.

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
