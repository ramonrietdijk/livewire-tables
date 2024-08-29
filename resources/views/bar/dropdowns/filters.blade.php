@if($table['filters']->isNotEmpty())
    <x-livewire-table::dropdown label="{{ __('Filters') }}" :active="count($this->filters) > 0">
        <x-slot name="icon">
            <!-- Icon "adjustments-horizontal" (outline) from https://heroicons.com -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
            </svg>
        </x-slot>
        <span
            class="flex gap-2 px-3 py-2 font-bold text-xs uppercase border-b border-neutral-200 bg-neutral-50 text-neutral-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
            <span class="mr-auto">@lang('Filters')</span>
            @if ($this->canClearFilters())
                <a href="#" class="text-red-500" x-on:click="show = false" wire:click.prevent="clearFilters">
                    @lang('Clear')
                </a>
            @endif
        </span>
        <div class="flex flex-col">
            @foreach($table['filters'] as $filter)
                <div class="border-b border-neutral-200 last:border-b-0 dark:border-neutral-700">
                    {{ $filter->render() }}
                </div>
            @endforeach
        </div>
    </x-livewire-table::dropdown>
@endif
