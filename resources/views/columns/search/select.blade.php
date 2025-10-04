<div class="px-3 pb-2">
    <x-livewire-table::form.select
        wire:model.live="search.{{ $column->code() }}"
        size="sm"
    >
        <option value="">&mdash;</option>
        @foreach($column->getOptions() as $key => $value)
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
</div>
