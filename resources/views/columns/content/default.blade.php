<div class="px-3 py-2 truncate text-black dark:text-white">
    @if($column->isRaw())
        {!! $value !!}
    @else
        {{ $value }}
    @endif
</div>
