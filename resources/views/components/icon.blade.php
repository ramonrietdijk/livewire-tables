@props(['icon'])

<span {{ $attributes->class('block') }}>
    @include('livewire-table::icons.'.$icon)
</span>
