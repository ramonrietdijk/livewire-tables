<div class="px-3 py-1">
    @if($value)
        <img
            class="max-w-none"
            src="{{ $value }}"
            alt="{{ $column->label() }}"
            width="{{ $column->getWidth() }}"
            height="{{ $column->getHeight() }}"
        >
    @endif
</div>
