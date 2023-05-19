@if(count($this->selected) > 0)
    <div class="w-full" wire:key="{{ $this->id }}-selection" wire:loading.remove>
        <div
            class="bg-blue-50 px-3 py-2 text-sm text-blue-800 border border-blue-100 rounded-md shadow-sm flex items-center gap-1 dark:bg-blue-900 dark:text-blue-300 dark:border-blue-600">
            <x-heroicon-o-list-bullet class="w-6 h-6"/>
            <span>
                @choice('Selected 1 record|Selected :value records', count($this->selected), ['value' => count($this->selected)])
            </span>
            <div class="flex flex-row gap-2 ml-auto pl-3">
                <a href="#" wire:click.prevent="selectTable(true)" class="underline ml-auto">
                    @lang('All')
                </a>
                <a href="#" wire:click.prevent="selectTable(false)" class="underline ml-auto">
                    @lang('None')
                </a>
                <a href="#" wire:click.prevent="clearSelection" class="underline ml-auto">
                    @lang('Clear')
                </a>
            </div>
        </div>
    </div>
@endif
