@use('Illuminate\Support\Js')

@php($actions = $this->resolveActions())

<x-livewire-table::dropdown.section section="actions">
    <x-livewire-table::dropdown.header :label="__('Actions')" icon="play" />
    <x-livewire-table::dropdown.content>
        @php($standaloneActions = $actions->standalone())
        @if($standaloneActions->isNotEmpty())
            <x-livewire-table::dropdown.menu>
                @foreach($standaloneActions as $standaloneAction)
                    <x-livewire-table::dropdown.menu.item
                        :label="$standaloneAction->label()"
                        wire:key="{{ $standaloneAction->code() }}"
                        x-data="LivewireTableAction({{ Js::from(['code' => $standaloneAction->code(), 'confirmation' => $standaloneAction->hasConfirmation() ? $standaloneAction->getConfirmationData() : null]) }})"
                        x-on:click="
                            execute(() => {
                                {{ $standaloneAction->isScript() ? $standaloneAction->script() : '$wire.executeAction(code)' }}
                            })
                            close()
                        "
                    />
                @endforeach
            </x-livewire-table::dropdown.menu>
        @endif
        @php($bulkActions = $actions->bulk())
        @if($bulkActions->isNotEmpty())
            <x-livewire-table::dropdown.menu x-data="{ selected: $wire.entangle('selected') }">
                @foreach($bulkActions as $bulkAction)
                    <x-livewire-table::dropdown.menu.item
                        :label="$bulkAction->label()"
                        wire:key="{{ $bulkAction->code() }}"
                        x-data="LivewireTableAction({{ Js::from(['code' => $bulkAction->code(), 'confirmation' => $bulkAction->hasConfirmation() ? $bulkAction->getConfirmationData() : null]) }})"
                        x-bind:disabled="selected.length === 0"
                        x-on:click="
                            execute(() => {
                                {{ $bulkAction->isScript() ? $bulkAction->script() : '$wire.executeAction(code)' }}
                            })
                            close()
                        "
                    />
                @endforeach
            </x-livewire-table::dropdown.menu>
        @endif
    </x-livewire-table::dropdown.content>
</x-livewire-table::dropdown.section>
