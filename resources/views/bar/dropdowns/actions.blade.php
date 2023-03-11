@if($table['actions']->isNotEmpty())
    <x-livewire-table::dropdown icon="heroicon-o-chevron-double-right" label="{{ __('Actions') }}">
        <div class="flex flex-col" x-data="{ selected: @entangle('selected') }">
        <span
            class="px-3 py-2 font-bold text-xs uppercase border-b border-neutral-200 bg-neutral-50 text-neutral-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
            @lang('Standalone Actions')
        </span>
            @foreach($table['actions']->filter(fn($action): bool => $action->isStandalone()) as $action)
                <button class="px-3 py-1 text-left truncate hover:bg-neutral-100 dark:hover:bg-neutral-700"
                        wire:click="executeAction('{{ $action->code() }}')"
                        x-on:click="show = false">
                    {{ $action->label() }}
                </button>
            @endforeach
            <span
                class="px-3 py-2 font-bold text-xs uppercase border-y border-neutral-200 bg-neutral-50 text-neutral-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
            @lang('Actions')
        </span>
            @foreach($table['actions']->filter(fn($action): bool => ! $action->isStandalone()) as $action)
                <button
                    class="px-3 py-1 text-left truncate hover:bg-neutral-100 disabled:hover:bg-white disabled:text-neutral-500 dark:hover:bg-neutral-700 dark:disabled:hover:bg-neutral-800"
                    x-bind:disabled="selected.length === 0"
                    wire:click="executeAction('{{ $action->code() }}')"
                    x-on:click="show = false">
                    {{ $action->label() }}
                </button>
            @endforeach
        </div>
    </x-livewire-table::dropdown>
@endif
