<table class="w-full relative" x-data="{ selected: @entangle('selected') }">
    <thead class="border-b border-neutral-200 dark:border-neutral-700">
    <tr class="group">
        @if($this->canSelect())
            <th class="p-0 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800">
                <input type="checkbox" wire:model.live="selectedPage" class="size-4 mx-3">
            </th>
        @endif
        @foreach($table['columns'] as $column)
            @continue(! in_array($column->code(), $this->columns))
            <th class="p-0 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800">
                {{ $column->renderHeader() }}
            </th>
        @endforeach
    </tr>
    <tr class="group">
        @if($this->canSelect())
            <th class="p-0 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800"></th>
        @endif
        @foreach($table['columns'] as $column)
            @continue(! in_array($column->code(), $this->columns))
            <th class="p-0 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800">
                @if($column->isSearchable())
                    {{ $column->renderSearch() }}
                @endif
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @if($this->deferLoading && ! $this->initialized)
        <tr class="group">
            <td class="p-0" colspan="{{ $table['columns']->count() + 1 }}">
                <span class="block text-lg text-center py-20 bg-white text-black dark:bg-neutral-900 dark:text-white">
                    @lang('Fetching records...')
                </span>
            </td>
        </tr>
    @else
        @forelse($paginator->items() as $item)
            <tr class="group"
                wire:key="row-{{ $item->getKey() }}"

                @if($this->isReordering())
                    draggable="true"
                    x-on:dragstart="e => e.dataTransfer.setData('key', '{{ $item->getKey() }}')"
                    x-on:dragover.prevent=""
                    x-on:drop="e => {
                        $wire.call(
                            'reorderItem',
                            e.dataTransfer.getData('key'),
                            '{{ $item->getKey() }}',
                            e.target.offsetHeight / 2 > e.offsetY
                        )
                    }"
                @endif
            >
                @if($this->canSelect())
                    <td class="p-0"
                        x-bind:class="~selected.indexOf('{{ $item->getKey() }}')
                                ? 'bg-blue-100 group-odd:bg-blue-100 group-hover:bg-blue-200 dark:bg-blue-900 dark:group-odd:bg-blue-900 dark:group-hover:bg-blue-800'
                                : 'bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700'">
                        <div class="mx-3">
                            <input type="checkbox" wire:model.live="selected" value="{{ $item->getKey() }}" class="size-4">
                        </div>
                    </td>
                @endif
                @foreach($table['columns'] as $column)
                    @continue(! in_array($column->code(), $this->columns))
                    <td class="p-0"
                        @if($column->isClickable() && ! $this->isReordering())
                            @if(($link = $this->link($item)) !== null)
                                x-on:click.prevent="window.location.href = '{{ $link }}'"
                            @elseif($this->canSelect())
                                x-on:click="$wire.selectItem('{{ $item->getKey() }}')"
                            @endif
                        @endif
                        x-bind:class="~selected.indexOf('{{ $item->getKey() }}')
                                ? 'select-none cursor-pointer bg-blue-100 group-odd:bg-blue-100 group-hover:bg-blue-200 dark:bg-blue-900 dark:group-odd:bg-blue-900 dark:group-hover:bg-blue-800'
                                : 'select-none cursor-pointer bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700'">
                        {{ $column->render($item) }}
                    </td>
                @endforeach
            </tr>
        @empty
            <tr class="group">
                <td class="p-0" colspan="{{ $table['columns']->count() + 1 }}">
                    <span class="block text-lg text-center py-20 bg-white text-black dark:bg-neutral-900 dark:text-white">
                        @lang('No results')
                    </span>
                </td>
            </tr>
        @endforelse
    @endif
    </tbody>
    <tfoot class="border-t border-neutral-200 dark:border-neutral-700">
    <tr class="group">
        @if($this->canSelect())
            <th class="p-0 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800"></th>
        @endif
        @foreach($table['columns'] as $column)
            @continue(! in_array($column->code(), $this->columns))
            <th class="p-0 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800">
                {{ $column->renderFooter() }}
            </th>
        @endforeach
    </tr>
    </tfoot>
</table>
