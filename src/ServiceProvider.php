<?php

namespace RamonRietdijk\LivewireTables;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-table');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-table'),
        ], 'views');
    }
}
