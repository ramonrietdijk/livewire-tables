<x-livewire-table::dropdown.section section="results">
    <x-livewire-table::dropdown.header :label="__('Results')" icon="chevron-left" navigate="configuration" />
    <x-livewire-table::dropdown.content>
        <x-livewire-table::form.group :label="__('Records')">
            <x-livewire-table::form.select name="perPage" wire:model.live="perPage">
                @foreach($perPageOptions as $perPage)
                    <option wire:key="{{ $perPage }}" value="{{ $perPage }}">{{ $perPage }}</option>
                @endforeach
            </x-livewire-table::form.select>
        </x-livewire-table::form.group>
        <x-livewire-table::dropdown.footer>
            @lang('Change the amount of visible records in the table.')
        </x-livewire-table::dropdown.footer>
    </x-livewire-table::dropdown.content>
</x-livewire-table::dropdown.section>
