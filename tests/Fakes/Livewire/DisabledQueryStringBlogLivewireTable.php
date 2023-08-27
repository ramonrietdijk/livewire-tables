<?php

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Livewire;

use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;

class DisabledQueryStringBlogLivewireTable extends LivewireTable
{
    protected string $model = Blog::class;

    protected bool $useQueryString = false;
}
