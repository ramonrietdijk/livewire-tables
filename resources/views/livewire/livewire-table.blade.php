<div
    class="flex flex-col gap-3 relative"
    @if($this->deferLoading) wire:init="init" @endif
    @if(strlen($polling = $this->polling()) > 0) wire:poll.{{ $polling }} @endif
>
    <div class="bg-gray-50 dark:bg-gray-800 rounded-md shadow-sm flex flex-col border border-gray-300 dark:border-gray-600 transition">
        @include('livewire-table::toolbar.toolbar')
        <div class="flex-1 overflow-y-auto max-h-179 rounded-b-md">
            @include('livewire-table::table.table')
        </div>
    </div>
    {{ $paginator->links('livewire-table::pagination.pagination') }}
</div>
