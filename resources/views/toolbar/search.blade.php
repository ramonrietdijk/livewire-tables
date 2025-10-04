<label class="relative group/search w-full sm:w-auto">
    <x-livewire-table::icon icon="magnifying-glass" class="absolute left-2 top-2.5 text-gray-400 size-5" />
    <input
        type="search"
        placeholder="@lang('Search all columns...')"
        @class([
            'pl-8 pr-3 py-2 rounded-md border transition w-full',
            'ring-blue-300 dark:ring-blue-400',
            'focus:outline-none focus:ring focus:z-10',
            'bg-gray-100 dark:bg-gray-700 group-hover/search:bg-gray-200 dark:group-hover/search:bg-gray-600 active:bg-gray-200 dark:active:bg-gray-600',
            'border-gray-100 dark:border-gray-700 group-hover/search:border-gray-200 dark:group-hover/search:border-gray-600 focus:border-blue-300 dark:focus:border-blue-400',
            'text-gray-800 dark:text-white',
        ])
        wire:model.live.debounce.500ms="globalSearch"
    >
</label>
