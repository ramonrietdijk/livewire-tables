@if($table['columns']->isNotEmpty())
    <x-livewire-table::dropdown label="{{ __('Columns') }}">
        <x-slot name="icon">
            <!-- Icon "view-columns" (outline) from https://heroicons.com -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z" />
            </svg>
        </x-slot>
        <span
            class="flex gap-2 px-3 py-2 font-bold text-xs uppercase border-b border-neutral-200 bg-neutral-50 text-neutral-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
            <span class="mr-auto">@lang('Columns')</span>
            <a href="#" class="text-blue-500" wire:click.prevent="selectAllColumns(true)">
                @lang('All')
            </a>
            <a href="#" class="text-blue-500" wire:click.prevent="selectAllColumns(false)">
                @lang('None')
            </a>
        </span>
        @foreach($table['columns'] as $column)
            <label
                wire:key="{{ $column->code() }}"
                class="flex items-center gap-2 px-3 py-1 cursor-pointer"
                draggable="true"
                x-on:dragstart="e => e.dataTransfer.setData('code', '{{ $column->code() }}')"
                x-on:dragover.prevent=""
                x-on:drop="e => {
                    $wire.call(
                        'reorderColumn',
                        e.dataTransfer.getData('code'),
                        '{{ $column->code() }}',
                        e.target.offsetHeight / 2 > e.offsetY
                    )
                }"
            >
                <input type="checkbox" class="size-4" value="{{ $column->code() }}" wire:model.live="columns">
                <span class="truncate" title="{{ $column->label() }}">{{ $column->label() }}</span>
            </label>
        @endforeach
    </x-livewire-table::dropdown>
@endif
