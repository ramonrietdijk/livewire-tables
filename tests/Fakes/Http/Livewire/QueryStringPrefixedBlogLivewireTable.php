<?php

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Http\Livewire;

use RamonRietdijk\LivewireTables\Http\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;

class QueryStringPrefixedBlogLivewireTable extends LivewireTable
{
    protected string $model = Blog::class;

    protected string $queryStringPrefix = 'blog';
}
