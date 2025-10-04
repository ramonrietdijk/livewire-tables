<x-livewire-table::dropdown current="actions">
    <x-livewire-table::button
        :title="__('Actions')"
        :aria-label="__('Actions')"
        x-on:click="toggle"
    >
        <x-livewire-table::icon class="size-6" icon="play" />
    </x-livewire-table::button>
    <x-slot:body>
        @include('livewire-table::toolbar.dropdowns.sections.actions')
    </x-slot:body>
</x-livewire-table::dropdown>
