# Table

In order to create your first table, you will have to extend the `LivewireTable` component. Via the `$model` variable
you can specify what model should be used.

```php
<?php

namespace App\Http\Livewire;

use RamonRietdijk\LivewireTables\Http\Livewire\LivewireTable;

class BlogTable extends LivewireTable
{
    protected string $model = Blog::class;
}
```

If you have manually created the file, Livewire may not yet know about this component. This can be fixed by
running `livewire:discover`.

```sh
php artisan livewire:discover
```

Depending on how you have named your table, you should be able to see it now.

```html
<livewire:blog-table/>
```

It works! But an empty table is a bit silly, right? Let's create some columns!
