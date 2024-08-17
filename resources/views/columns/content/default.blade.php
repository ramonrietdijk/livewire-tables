<div class="px-3 py-2 truncate text-black dark:text-white">
    @if($value === null)
        <span class="opacity-25">&mdash;</span>
    @elseif($column->isRaw())
        {!! $value !!}
    @else
        {{ $value }}
    @endif
</div>
