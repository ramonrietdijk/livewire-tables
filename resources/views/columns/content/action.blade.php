@php($actions = $this->resolveActions()->standalone(false)->canBeRun($model))

<div class="px-3 py-1">
    <x-livewire-table::dropdown current="actions">
        <x-livewire-table::button
            size="sm"
            :title="__('Actions')"
            :aria-label="__('Actions')"
            x-on:click="toggle"
        >
            <x-livewire-table::icon class="size-5" icon="play" />
        </x-livewire-table::button>
        <x-slot:body>
            <x-livewire-table::dropdown.section section="actions">
                <x-livewire-table::dropdown.header :label="__('Actions')" icon="play" />
                <x-livewire-table::dropdown.content>
                    <x-livewire-table::dropdown.menu x-data="{ selected: [item] }">
                        @foreach($actions as $action)
                            <x-livewire-table::dropdown.menu.item
                                :label="$action->label()"
                                wire:key="{{ $action->code() }}"
                                x-data="LivewireTableAction({{ Js::from(['code' => $action->code(), 'confirmation' => $action->hasConfirmation() ? $action->getConfirmationData() : null]) }})"
                                x-on:click="
                                    execute(() => {
                                        {{ $action->isScript() ? $action->script() : '$wire.executeItemAction(code, item)' }}
                                    })
                                    close()
                                "
                            />
                        @endforeach
                    </x-livewire-table::dropdown.menu>
                </x-livewire-table::dropdown.content>
            </x-livewire-table::dropdown.section>
        </x-slot:body>
    </x-livewire-table::dropdown>
</div>
