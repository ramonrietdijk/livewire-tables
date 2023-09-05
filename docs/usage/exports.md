# Exports

Exporting data from the table can be really useful to quickly get all records in a spreadsheet. Creating an export functionality is very simple using [actions](/usage/actions).

The example below makes use of [maatwebsite/excel](https://laravel-excel.com/). It is not required to use this package, as you can use anything you want. If you are planning to use `maatwebsite/excel`, please follow the installation instructions before continuing.

## Example

Start by adding an action to your table. This example will make use of a [standalone](/usage/actions#standalone) action. By doing so, all records that are available in the table will be included in the export while respecting all filters and sortings.

```php
protected function actions(): array
{
    return [
        Action::make(__('Export All'), 'export_all', function (): mixed {
            $collection = $this->appliedQuery()->get();

            return Excel::download(
                new BlogExport($collection), 'blogs.xlsx',
            );
        })->standalone(),
    ];
}
```

You can also use a regular action, only exporting records that have been selected.

```php
protected function actions(): array
{
    return [
        Action::make(__('Export'), 'export', function (Enumerable $models): mixed {
            return Excel::download(
                new BlogExport($models), 'blogs.xlsx',
            );
        }),
    ];
}
```

An example of the `BlogExport` could look like the following. Note that any formatting can be applied in this class.

```php
<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class BlogExport implements FromCollection
{
    public function __construct(
        protected Collection $collection
    ) {
    }

    public function collection()
    {
        return $this->collection;
    }
}
```
