@php($columns = $this->resolveColumns())
@php($filters = $this->resolveFilters())

<x-livewire-table::dropdown current="configuration">
    <x-livewire-table::button
        :title="__('Configuration')"
        :aria-label="__('Configuration')"
        x-on:click="toggle"
        :dot="$this->canClearFilters()"
    >
        <x-livewire-table::icon class="size-6" icon="cog-6-tooth" />
    </x-livewire-table::button>
    <x-slot:body>
        @include('livewire-table::toolbar.dropdowns.sections.configuration')
        @includeWhen($columns->isNotEmpty(), 'livewire-table::toolbar.dropdowns.sections.columns')
        @includeWhen($filters->isNotEmpty(), 'livewire-table::toolbar.dropdowns.sections.filters')
        @includeWhen($this->hasSoftDeletes(), 'livewire-table::toolbar.dropdowns.sections.trashed')
        @include('livewire-table::toolbar.dropdowns.sections.results')
        @includeWhen(count($pollingOptions) > 0, 'livewire-table::toolbar.dropdowns.sections.polling')
    </x-slot:body>
</x-livewire-table::dropdown>
