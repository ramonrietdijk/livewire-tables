@props(['icon'])

<div {{ $attributes->class('p-3 rounded-md transition') }}>
    <x-livewire-table::icon :$icon class="size-6" />
</div>
