<div class="px-3 py-2 truncate">
    @if(($content = $column->getFooterContent()) !== null)
        {!! $content !!}
    @else
        &nbsp;
    @endif
</div>
