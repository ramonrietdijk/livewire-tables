<x-livewire-table::dropdown.section section="suggestions">
    <x-livewire-table::dropdown.header :label="__('Suggestions')" icon="ellipsis-vertical" />
    <x-livewire-table::dropdown.content>
        <x-livewire-table::dropdown.menu>
            <x-livewire-table::dropdown.menu.item :label="__('Select all records')" icon="plus" wire:click="selectTable(true)" x-on:click="close" />
            <x-livewire-table::dropdown.menu.item :label="__('Subtract records')" icon="min" wire:click="selectTable(false)" x-on:click="close" />
            <x-livewire-table::dropdown.menu.item :label="__('Clear selection')" icon="x-mark" wire:click="clearSelection" x-on:click="close" />
        </x-livewire-table::dropdown.menu>
    </x-livewire-table::dropdown.content>
</x-livewire-table::dropdown.section>
