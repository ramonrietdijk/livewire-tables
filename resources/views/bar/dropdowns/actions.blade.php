@if($table['actions']->isNotEmpty())
    <x-livewire-table::dropdown label="{{ __('Actions') }}">
        <x-slot name="icon">
            <!-- Icon "chevron-double-right" (outline) from https://heroicons.com -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
            </svg>
        </x-slot>
        <div class="flex flex-col" x-data="{ selected: @entangle('selected') }">
            @php($standaloneActions = $table['actions']->filter(fn($action): bool => $action->isStandalone()))
            @if($standaloneActions->isNotEmpty())
                <div class="flex flex-col border-b border-neutral-200 dark:border-neutral-700 last:border-b-0">
                    <span
                        class="px-3 py-2 font-bold text-xs uppercase border-b border-neutral-200 bg-neutral-50 text-neutral-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                        @lang('Standalone Actions')
                    </span>
                    @foreach($standaloneActions as $standaloneAction)
                        <button class="px-3 py-1 text-left truncate hover:bg-neutral-100 dark:hover:bg-neutral-700"
                                wire:click="executeAction('{{ $standaloneAction->code() }}')"
                                x-on:click="show = false">
                            {{ $standaloneAction->label() }}
                        </button>
                    @endforeach
                </div>
            @endif

            @php($actions = $table['actions']->filter(fn($action): bool => ! $action->isStandalone()))
            @if($actions->isNotEmpty())
                <div class="flex flex-col border-b border-neutral-200 dark:border-neutral-700 last:border-b-0">
                    <span
                        class="px-3 py-2 font-bold text-xs uppercase border-b border-neutral-200 bg-neutral-50 text-neutral-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                        @lang('Actions')
                    </span>
                    @foreach($actions as $action)
                        <button
                            class="px-3 py-1 text-left truncate hover:bg-neutral-100 disabled:hover:bg-white disabled:text-neutral-500 dark:hover:bg-neutral-700 dark:disabled:hover:bg-neutral-800"
                            x-bind:disabled="selected.length === 0"
                            wire:click="executeAction('{{ $action->code() }}')"
                            x-on:click="show = false">
                            {{ $action->label() }}
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </x-livewire-table::dropdown>
@endif
