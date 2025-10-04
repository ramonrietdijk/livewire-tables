<div class="px-3 pb-2">
    <x-livewire-table::form.input
        wire:model.live.debounce.500ms="search.{{ $column->code() }}"
        size="sm"
        type="date"
    />
</div>
