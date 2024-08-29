<x-livewire-table::button
    :title="__('Reordering')"
    :aria-label="__('Reordering')"
    wire:click="$toggle('reordering')"
    :active="$this->reordering"
>
    <!-- Icon "queue-list" (outline) from https://heroicons.com -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
    </svg>
</x-livewire-table::button>
