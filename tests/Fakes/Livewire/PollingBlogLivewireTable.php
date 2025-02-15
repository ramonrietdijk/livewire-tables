<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Livewire;

use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;

class PollingBlogLivewireTable extends LivewireTable
{
    protected string $model = Blog::class;

    protected array $pollingOptions = [
        '' => 'None',
        '10s' => 'Every 10 seconds',
    ];
}
