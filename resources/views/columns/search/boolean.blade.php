<div class="px-3 pb-2">
    <x-livewire-table::form.select
        wire:model.live="search.{{ $column->code() }}"
        size="sm"
    >
        <option value="">&mdash;</option>
        <option value="1">@lang('Yes')</option>
        <option value="0">@lang('No')</option>
    </x-livewire-table::form.select>
</div>
