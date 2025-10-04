@if($slot->hasActualContent())
    <ul {{ $attributes->class('py-1 transition') }}>
        {{ $slot }}
    </ul>
@endif
