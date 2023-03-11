@if($table['columns']->isNotEmpty())
    <x-livewire-table::dropdown icon="heroicon-o-view-columns" label="{{ __('Columns') }}">
    <span
        class="flex gap-2 px-3 py-2 font-bold text-xs uppercase border-b border-neutral-200 bg-neutral-50 text-neutral-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
        <span>@lang('Columns')</span>
        <a href="#" class="ml-auto text-blue-500" wire:click.prevent="selectAllColumns(true)">
            @lang('All')
        </a>
        <a href="#" class="text-blue-500" wire:click.prevent="selectAllColumns(false)">
            @lang('None')
        </a>
    </span>
        @foreach($table['columns'] as $column)
            <label class="flex items-center gap-2 px-3 py-1 cursor-pointer">
                <input type="checkbox" class="h-4 w-4" value="{{ $column->code() }}" wire:model="columns">
                <span class="truncate" title="{{ $column->label() }}">{{ $column->label() }}</span>
            </label>
        @endforeach
    </x-livewire-table::dropdown>
@endif
