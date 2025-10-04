<x-livewire-table::button
    :title="__('Clear search')"
    :aria-label="__('Clear search')"
    wire:click="clearSearch"
>
    <x-livewire-table::icon class="size-6" icon="backspace" />
</x-livewire-table::button>
