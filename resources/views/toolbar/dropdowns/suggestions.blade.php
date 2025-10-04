<x-livewire-table::dropdown current="suggestions">
    <x-livewire-table::notification.button
        :title="__('Suggestions')"
        :aria-label="__('Suggestions')"
        x-on:click="toggle"
        class="rounded-r-md"
    >
        <x-livewire-table::icon class="size-6" icon="ellipsis-vertical" />
    </x-livewire-table::notification.button>
    <x-slot:body>
        @include('livewire-table::toolbar.dropdowns.sections.suggestions')
    </x-slot:body>
</x-livewire-table::dropdown>
