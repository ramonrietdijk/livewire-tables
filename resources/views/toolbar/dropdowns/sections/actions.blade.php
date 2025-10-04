@php($actions = $this->resolveActions())

<x-livewire-table::dropdown.section section="actions">
    <x-livewire-table::dropdown.header :label="__('Actions')" icon="play" />
    <x-livewire-table::dropdown.content>
        @php($standaloneActions = $actions->standalone())
        @if($standaloneActions->isNotEmpty())
            <x-livewire-table::dropdown.menu>
                @foreach($standaloneActions as $standaloneAction)
                    @if($standaloneAction->isScript())
                        <x-livewire-table::dropdown.menu.item
                            :label="$standaloneAction->label()"
                            wire:key="{{ $standaloneAction->code() }}"
                            x-on:click="
                                {{ $standaloneAction->script() }}
                                close()
                            "
                        />
                    @else
                        <x-livewire-table::dropdown.menu.item
                            :label="$standaloneAction->label()"
                            wire:key="{{ $standaloneAction->code() }}"
                            wire:click="executeAction({{ Js::from($standaloneAction->code()) }})"
                            x-on:click="close"
                        />
                    @endif
                @endforeach
            </x-livewire-table::dropdown.menu>
        @endif
        @php($bulkActions = $actions->bulk())
        @if($bulkActions->isNotEmpty())
            <x-livewire-table::dropdown.menu x-data="{ selected: $wire.entangle('selected') }">
                @foreach($bulkActions as $bulkAction)
                    @if($bulkAction->isScript())
                        <x-livewire-table::dropdown.menu.item
                            :label="$bulkAction->label()"
                            wire:key="{{ $bulkAction->code() }}"
                            x-bind:disabled="selected.length === 0"
                            x-on:click="
                                {{ $bulkAction->script() }}
                                close()
                            "
                        />
                    @else
                        <x-livewire-table::dropdown.menu.item
                            :label="$bulkAction->label()"
                            wire:key="{{ $bulkAction->code() }}"
                            x-bind:disabled="selected.length === 0"
                            wire:click="executeAction({{ Js::from($bulkAction->code()) }})"
                            x-on:click="close"
                        />
                    @endif
                @endforeach
            </x-livewire-table::dropdown.menu>
        @endif
    </x-livewire-table::dropdown.content>
</x-livewire-table::dropdown.section>
