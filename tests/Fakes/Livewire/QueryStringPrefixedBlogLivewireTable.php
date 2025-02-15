<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Livewire;

use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;

class QueryStringPrefixedBlogLivewireTable extends LivewireTable
{
    protected string $model = Blog::class;

    protected string $queryStringPrefix = 'blog';
}
