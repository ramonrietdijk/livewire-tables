<x-livewire-table::dropdown.section section="polling">
    <x-livewire-table::dropdown.header :label="__('Reload')" icon="chevron-left" navigate="configuration" />
    <x-livewire-table::dropdown.content>
        <x-livewire-table::form.group :label="__('Interval')">
            <x-livewire-table::form.select name="polling" wire:model.live="polling">
                @foreach($pollingOptions as $key => $value)
                    <option wire:key="{{ $key }}" value="{{ $key }}">@lang($value)</option>
                @endforeach
            </x-livewire-table::form.select>
        </x-livewire-table::form.group>
        <x-livewire-table::dropdown.footer>
            @lang('Automatically refresh the table with the given interval.')
        </x-livewire-table::dropdown.footer>
    </x-livewire-table::dropdown.content>
</x-livewire-table::dropdown.section>
