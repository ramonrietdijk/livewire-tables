<div class="px-3 py-2 truncate text-black dark:text-white">
    @if(($content = $column->getFooterContent()) !== null)
        {!! $content !!}
    @else
        &nbsp;
    @endif
</div>
