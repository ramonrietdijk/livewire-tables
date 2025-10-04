<x-livewire-table::form.group :label="$filter->label()">
    <x-livewire-table::form.select wire:model.live="filters.{{ $filter->code() }}">
        <option value="">&mdash;</option>
        <option value="1">@lang('Yes')</option>
        <option value="0">@lang('No')</option>
    </x-livewire-table::form.select>
</x-livewire-table::form.group>
