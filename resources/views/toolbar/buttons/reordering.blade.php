<x-livewire-table::button
    :title="__('Reordering')"
    :aria-label="__('Reordering')"
    wire:click="$toggle('reordering')"
    :active="$this->isReordering()"
>
    <x-livewire-table::icon class="size-6" icon="queue-list" />
</x-livewire-table::button>
