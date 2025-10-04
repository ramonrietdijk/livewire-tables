@php($columns = $this->resolveColumns())

<x-livewire-table::dropdown.section section="columns">
    <x-livewire-table::dropdown.header :label="__('Columns')" icon="chevron-left" navigate="configuration" />
    <x-livewire-table::dropdown.content>
        <x-livewire-table::dropdown.menu>
            @foreach($columns as $column)
                <li>
                    <label
                        wire:key="{{ $column->code() }}"
                        class="flex items-center gap-2 px-4 py-1 cursor-grab text-gray-700 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                        draggable="true"
                        x-on:dragstart="e => e.dataTransfer.setData('code', @js($column->code()))"
                        x-on:dragover.prevent=""
                        x-on:drop="e => {
                            $wire.call(
                                'reorderColumn',
                                e.dataTransfer.getData('code'),
                                @js($column->code()),
                                e.target.offsetHeight / 2 > e.offsetY
                            )
                        }"
                    >
                        <x-livewire-table::form.checkbox value="{{ $column->code() }}" wire:model.live="columns" />
                        <span class="truncate" title="{{ $column->label() }}">{{ $column->label() }}</span>
                    </label>
                </li>
            @endforeach
        </x-livewire-table::dropdown.menu>
        <x-livewire-table::dropdown.footer>
            @lang('Select the columns you want to see. Drag them to change order.')
        </x-livewire-table::dropdown.footer>
    </x-livewire-table::dropdown.content>
</x-livewire-table::dropdown.section>
