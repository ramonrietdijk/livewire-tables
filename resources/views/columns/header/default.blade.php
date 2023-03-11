@if($column->isSortable())
    <a href="#"
       class="flex items-center gap-1 font-bold text-md px-3 py-2 whitespace-nowrap"
       wire:click.prevent="sort('{{ $column->code() }}')">
        <span>{{ $column->label() }}</span>
        @if($this->sortColumn === $column->code())
            @if($this->sortDirection === 'asc')
                <x-heroicon-o-chevron-up class="w-4 h-4"/>
            @else
                <x-heroicon-o-chevron-down class="w-4 h-4"/>
            @endif
        @endif
    </a>
@else
    <span class="flex font-bold text-md px-3 py-2 whitespace-nowrap">{{ $column->label() }}</span>
@endif
