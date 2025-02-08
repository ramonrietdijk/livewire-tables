@if(count($this->selected) > 0)
    <div class="w-full" wire:key="{{ $this->getId() }}-selection" wire:loading.remove>
        <div
            class="bg-blue-50 px-3 py-2 text-sm text-blue-800 border border-blue-100 rounded-md shadow-xs flex items-center gap-1 dark:bg-blue-900 dark:text-blue-300 dark:border-blue-600">
            <!-- Icon "list-bullet" (outline) from https://heroicons.com -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
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
