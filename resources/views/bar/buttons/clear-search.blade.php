<button
    class="flex items-center gap-1 px-3 py-2 bg-white border border-neutral-200 text-neutral-800 hover:text-neutral-500 focus:border-blue-300 active:bg-neutral-100 active:text-neutral-800 transition ease-in-out rounded-md shadow-xs h-full text-sm dark:bg-neutral-800 dark:border-neutral-700 dark:focus:border-blue-600 dark:text-neutral-300 dark:hover:text-white dark:focus:border-blue-600 dark:active:bg-neutral-900 dark:active:text-white"
    title="{{ __('Clear search') }}"
    aria-label="{{ __('Clear search') }}"
    wire:click="clearSearch"
>
    <!-- Icon "backspace" (outline) from https://heroicons.com -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" />
    </svg>
</button>
