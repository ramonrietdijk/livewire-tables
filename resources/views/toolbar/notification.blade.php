<div class="flex-1 basis-full order-last lg:order-none lg:basis-auto">
    @if($this->isReordering())
        <x-livewire-table::notification :label="__('Drag records to reorder them.')" icon="information-circle">
            <x-livewire-table::notification.button
                :title="__('Close')"
                :aria-label="__('Close')"
                wire:click="$toggle('reordering')"
                class="rounded-r-md"
            >
                <x-livewire-table::icon class="size-6" icon="x-mark" />
            </x-livewire-table::notification.button>
        </x-livewire-table::notification>
    @else
        <template x-if="$wire.selected.length > 0">
            <x-livewire-table::notification icon="check-circle">
                <x-slot:label>
                    <template x-if="$wire.selected.length === 1">
                        <span>
                            @lang('Selected 1 record.')
                        </span>
                    </template>
                    <template x-if="$wire.selected.length !== 1">
                        <span>
                            @lang('Selected :count records.', ['count' => '<span x-text="$wire.selected.length"></span>'])
                        </span>
                    </template>
                </x-slot:label>
                @include('livewire-table::toolbar.dropdowns.suggestions')
            </x-livewire-table::notification>
        </template>
    @endif
</div>
