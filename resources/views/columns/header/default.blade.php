@if($column->isSortable())
    <a href="#"
       class="flex items-center gap-1 font-bold text-md px-3 py-2 whitespace-nowrap"
       wire:click.prevent="sort('{{ $column->code() }}')">
        <span>{{ $column->label() }}</span>
        @if($this->sortColumn === $column->code())
            @if($this->sortDirection === 'asc')
                <!-- Icon "chevron-up" (outline) from https://heroicons.com -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                </svg>
            @else
                <!-- Icon "chevron-down" (outline) from https://heroicons.com -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            @endif
        @endif
    </a>
@else
    <span class="flex font-bold text-md px-3 py-2 whitespace-nowrap">{{ $column->label() }}</span>
@endif
