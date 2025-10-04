@if($column->isSortable())
    <button
       type="button"
       wire:click="sort(@js($column->code()))"
       class="flex items-center w-full gap-3 px-3 py-2 whitespace-nowrap cursor-pointer text-left hover:text-gray-800 dark:hover:text-gray-200 transition"
    >
        <span class="flex-1">{{ $column->label() }}</span>
        @if(! $this->isReordering())
            @if($this->sortColumn === $column->code())
                @if($this->sortDirection === 'asc')
                    <x-livewire-table::icon icon="chevron-up" class="size-4" />
                @else
                    <x-livewire-table::icon icon="chevron-down" class="size-4" />
                @endif
            @else
                <x-livewire-table::icon icon="chevron-up-down" class="size-4 opacity-50" />
            @endif
        @endif
    </button>
@else
    <span class="block px-3 py-2 whitespace-nowrap">{{ $column->label() }}</span>
@endif
