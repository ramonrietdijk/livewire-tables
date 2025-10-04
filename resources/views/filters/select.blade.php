<x-livewire-table::form.group :label="$filter->label()">
    @if($filter->isMultiple())
        <x-livewire-table::form.select wire:model.live="filters.{{ $filter->code() }}" multiple>
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
    @else
        <x-livewire-table::form.select wire:model.live="filters.{{ $filter->code() }}">
            <option value="">&mdash;</option>
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
    @endif
</x-livewire-table::form.group>
