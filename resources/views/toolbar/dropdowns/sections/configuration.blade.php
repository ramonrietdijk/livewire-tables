@php($columns = $this->resolveColumns())
@php($filters = $this->resolveFilters())

<x-livewire-table::dropdown.section section="configuration">
    <x-livewire-table::dropdown.header :label="__('Configuration')" icon="cog-6-tooth" />
    <x-livewire-table::dropdown.content>
        <x-livewire-table::dropdown.menu>
            @if($columns->isNotEmpty())
                <x-livewire-table::dropdown.menu.item :label="__('Columns')" icon="view-columns" navigate="columns" />
            @endif
            @if($filters->isNotEmpty())
                <x-livewire-table::dropdown.menu.item :label="__('Filters')" icon="funnel" navigate="filters" :dot="$this->canClearFilters()" />
            @endif
            @if($this->hasSoftDeletes())
                <x-livewire-table::dropdown.menu.item :label="__('Visibility')" icon="eye" navigate="trashed" />
            @endif
        </x-livewire-table::dropdown.menu>
        <x-livewire-table::dropdown.menu>
            <x-livewire-table::dropdown.menu.item :label="__('Results')" icon="list-bullet" navigate="results" />
            @if(count($pollingOptions) > 0)
                <x-livewire-table::dropdown.menu.item :label="__('Reload')" icon="clock" navigate="polling" />
            @endif
        </x-livewire-table::dropdown.menu>
        <x-livewire-table::dropdown.menu>
            <x-livewire-table::dropdown.menu.item :label="__('Refresh')" icon="arrow-path" wire:click="$refresh" x-on:click="close" />
        </x-livewire-table::dropdown.menu>
    </x-livewire-table::dropdown.content>
</x-livewire-table::dropdown.section>
