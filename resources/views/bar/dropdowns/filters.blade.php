@if($table['filters']->isNotEmpty())
    <x-livewire-table::dropdown icon="heroicon-o-adjustments-horizontal"
                                label="{{ __('Filters') }}"
                                :count="count($this->filters)">
    <span
        class="flex gap-2 px-3 py-2 font-bold text-xs uppercase border-b border-neutral-200 bg-neutral-50 text-neutral-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
        <span>@lang('Filters')</span>
         <a href="#" class="ml-auto text-red-500" x-on:click="show = false" wire:click.prevent="clearFilters">
            @lang('Clear')
        </a>
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
