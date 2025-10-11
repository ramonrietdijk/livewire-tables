# Related Records

If a table has been configured, it will show all records of the given model. If you're working with relations, you may only want to display the related records of the parent model. An example for this would be to only show orders that have been placed by a specific user.

::: info
You will need to implement any [authorization](https://laravel.com/docs/master/authorization) yourself.
:::

Start by adding a public property to your table. You can optionally add the [Locked](https://livewire.laravel.com/docs/locked) attribute for safety. After that, override the `query` method and add any conditions you need.

```php
<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Locked;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;

class OrdersTable extends LivewireTable
{
    protected string $model = Order::class;

    #[Locked]
    public int $userId;

    /** @return Builder<covariant Model> */
    protected function query(): Builder
    {
        return $this->model()->query()->where('user_id', '=', $this->userId);
    }
}
```

Next, supply the user id via the view.

```html
<livewire:orders-table :userId="$user->id" />
```

The property will automatically be assigned to the class. You do not need to add the `mount` method.
