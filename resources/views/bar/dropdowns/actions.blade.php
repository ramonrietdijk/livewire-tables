@php($allActions = $this->resolveActions())

@if($allActions->isNotEmpty())
    <x-livewire-table::dropdown label="{{ __('Actions') }}">
        <x-slot name="icon">
            <!-- Icon "play" (outline) from https://heroicons.com -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
            </svg>
        </x-slot>
        <div class="flex flex-col" x-data="{ selected: @entangle('selected') }">
            @php($standaloneActions = $allActions->standalone())
            @if($standaloneActions->isNotEmpty())
                <div class="flex flex-col border-b border-neutral-200 dark:border-neutral-700 last:border-b-0">
                    <span
                        class="px-3 py-2 font-bold text-xs uppercase border-b border-neutral-200 bg-neutral-50 text-neutral-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                        @lang('Standalone Actions')
                    </span>
                    @foreach($standaloneActions as $standaloneAction)
                        @if($standaloneAction->callback() === null)
                            <button class="px-3 py-1 text-left truncate hover:bg-neutral-100 dark:hover:bg-neutral-700"
                                    x-on:click="
                                        {{ $standaloneAction->code() }}
                                        show = false
                                    "
                                    type="button">
                                {{ $standaloneAction->label() }}
                            </button>
                        @else
                            <button class="px-3 py-1 text-left truncate hover:bg-neutral-100 dark:hover:bg-neutral-700"
                                    wire:key="{{ $standaloneAction->code() }}"
                                    wire:click="executeAction('{{ $standaloneAction->code() }}')"
                                    x-on:click="show = false"
                                    type="button">
                                {{ $standaloneAction->label() }}
                            </button>
                        @endif
                    @endforeach
                </div>
            @endif

            @php($bulkActions = $allActions->bulk())
            @if($bulkActions->isNotEmpty())
                <div class="flex flex-col border-b border-neutral-200 dark:border-neutral-700 last:border-b-0">
                    <span
                        class="px-3 py-2 font-bold text-xs uppercase border-b border-neutral-200 bg-neutral-50 text-neutral-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                        @lang('Bulk Actions')
                    </span>
                    @foreach($bulkActions as $bulkAction)
                        @if($bulkAction->callback() === null)
                            <button
                                class="px-3 py-1 text-left truncate hover:bg-neutral-100 disabled:hover:bg-white disabled:text-neutral-500 dark:hover:bg-neutral-700 dark:disabled:hover:bg-neutral-800"
                                x-bind:disabled="selected.length === 0"
                                x-on:click="
                                    {{ $bulkAction->code() }}
                                    show = false
                                "
                                type="button">
                                {{ $bulkAction->label() }}
                            </button>
                        @else
                            <button
                                class="px-3 py-1 text-left truncate hover:bg-neutral-100 disabled:hover:bg-white disabled:text-neutral-500 dark:hover:bg-neutral-700 dark:disabled:hover:bg-neutral-800"
                                x-bind:disabled="selected.length === 0"
                                wire:key="{{ $bulkAction->code() }}"
                                wire:click="executeAction('{{ $bulkAction->code() }}')"
                                x-on:click="show = false"
                                type="button">
                                {{ $bulkAction->label() }}
                            </button>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </x-livewire-table::dropdown>
@endif
