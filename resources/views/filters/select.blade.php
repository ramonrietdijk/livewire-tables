<x-livewire-table::form.group :label="$filter->label()">
    <x-livewire-table::form.select wire:model.live="filters.{{ $filter->code() }}" :multiple="$filter->isMultiple()">
        @if(! $filter->isMultiple())
            <option value="">&mdash;</option>
        @endif
        @foreach($filter->getOptions() as $key => $value)
            @if(is_array($value))
                <optgroup wire:key="{{ $key }}" label="{{ $key }}">
                    @foreach($value as $key2 => $value2)
                        <option wire:key="{{ $key2 }}" value="{{ $key2 }}">{{ $value2 }}</option>
                    @endforeach
                </optgroup>
            @else
                <option wire:key="{{ $key }}" value="{{ $key }}">{{ $value }}</option>
            @endif
        @endforeach
    </x-livewire-table::form.select>
</x-livewire-table::form.group>
