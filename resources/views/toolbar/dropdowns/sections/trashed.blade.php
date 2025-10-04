<x-livewire-table::dropdown.section section="trashed">
    <x-livewire-table::dropdown.header :label="__('Visibility')" icon="chevron-left" navigate="configuration" />
    <x-livewire-table::dropdown.content>
        <x-livewire-table::form.group :label="__('Show')">
            <x-livewire-table::form.select name="trashed" wire:model.live="trashed">
                <option value="withoutTrashed">@lang('Without Trashed')</option>
                <option value="withTrashed">@lang('With Trashed')</option>
                <option value="onlyTrashed">@lang('Only Trashed')</option>
            </x-livewire-table::form.select>
        </x-livewire-table::form.group>
        <x-livewire-table::dropdown.footer>
            @lang('Configure what type of records should be shown in the table.')
        </x-livewire-table::dropdown.footer>
    </x-livewire-table::dropdown.content>
</x-livewire-table::dropdown.section>
