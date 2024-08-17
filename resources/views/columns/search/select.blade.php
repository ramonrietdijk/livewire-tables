<div class="px-3 py-1">
    <select
        class="min-w-full border border-neutral-200 rounded-md shadow-sm outline-none bg-white text-black focus:border-blue-300 mr-auto px-2 py-1 font-normal transition ease-in-out dark:bg-neutral-900 dark:border-neutral-700 dark:focus:border-blue-600 dark:text-white h-8"
        wire:model.live="search.{{ $column->code() }}">
        <option value="">&mdash;</option>
        @foreach($column->getOptions() as $key => $value)
            @if (is_array($value))
                <optgroup label="{{ $key }}">
                    @foreach($value as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </optgroup>
            @else
                <option value="{{ $key }}">{{ $value }}</option>
            @endif
        @endforeach
    </select>
</div>
