<div class="px-3 py-2">
    <span class="block whitespace-nowrap truncate" title="{{ $filter->label() }}">
        {{ $filter->label() }}
    </span>
    <select class="w-full border border-neutral-200 rounded-md shadow-xs outline-hidden bg-white text-black focus:border-blue-300 mr-auto px-3 py-2 font-normal transition ease-in-out dark:bg-neutral-900 dark:border-neutral-700 dark:focus:border-blue-600 dark:text-white"
            wire:model.live="filters.{{ $filter->code() }}"

            @if($filter->isMultiple())
                multiple
            @endif
        >
        @if(! $filter->isMultiple())
            <option value="">&mdash;</option>
        @endif
        @foreach($filter->getOptions() as $key => $value)
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
