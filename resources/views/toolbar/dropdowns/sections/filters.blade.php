@php($filters = $this->resolveFilters())

<x-livewire-table::dropdown.section section="filters">
    <x-livewire-table::dropdown.header :label="__('Filters')" icon="chevron-left" navigate="configuration">
        @if($this->canClearFilters())
            <button
                @class([
                    'flex items-center gap-3 px-4 py-3 text-sm border cursor-pointer rounded-tr-md transition',
                    'ring-red-300 dark:ring-red-400',
                    'focus:outline-none focus:ring focus:z-10',
                    'bg-gray-50 dark:bg-gray-700 hover:bg-red-50 dark:hover:bg-gray-600 active:bg-red-50 dark:active:bg-gray-600',
                    'border-gray-50 dark:border-gray-700 hover:border-red-50 dark:hover:border-gray-600 focus:border-red-300 dark:focus:border-red-400',
                    'text-red-600 dark:text-red-500',
                ])
                type="button"
                title="@lang('Reset the filters')"
                aria-label="@lang('Reset the filters')"
                wire:click="clearFilters"
                x-on:click="close"
            >
                @lang('Reset')
            </button>
        @endif
    </x-livewire-table::dropdown.header>
    <x-livewire-table::dropdown.content>
        @foreach($filters as $filter)
            <div wire:key="{{ $filter->code() }}" class="transition">
                {{ $filter->render() }}
            </div>
        @endforeach
        <x-livewire-table::dropdown.footer>
            @lang('Enable filters to narrow down your results.')
        </x-livewire-table::dropdown.footer>
    </x-livewire-table::dropdown.content>
</x-livewire-table::dropdown.section>
