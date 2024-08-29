<div class="px-3 py-2">
    @if($value === null)
        <div class="mx-auto size-3 border-2 border-neutral-300 rounded-full"></div>
    @elseif($value)
        <div class="mx-auto size-3 border-2 border-green-500 rounded-full"></div>
    @else
        <div class="mx-auto size-3 border-2 border-red-500 rounded-full"></div>
    @endif
</div>
