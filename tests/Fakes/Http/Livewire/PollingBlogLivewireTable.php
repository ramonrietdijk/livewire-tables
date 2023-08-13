<?php

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Http\Livewire;

use RamonRietdijk\LivewireTables\Http\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;

class PollingBlogLivewireTable extends LivewireTable
{
    protected string $model = Blog::class;

    protected array $pollingOptions = [
        '' => 'None',
        '10s' => 'Every 10 seconds',
    ];
}
