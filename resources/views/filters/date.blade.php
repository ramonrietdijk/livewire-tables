<x-livewire-table::dropdown.divider>
    <x-livewire-table::form.group :label="__(':label (from)', ['label' => $filter->label()])">
        <x-livewire-table::form.input type="date" wire:model.live="filters.{{ $filter->code() }}.from" />
    </x-livewire-table::form.group>
    <x-livewire-table::form.group :label="__(':label (to)', ['label' => $filter->label()])">
        <x-livewire-table::form.input type="date" wire:model.live="filters.{{ $filter->code() }}.to" />
    </x-livewire-table::form.group>
</x-livewire-table::dropdown.divider>
