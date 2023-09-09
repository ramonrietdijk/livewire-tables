<button
    @class([
        'flex items-center gap-1 px-3 py-2 bg-white border transition ease-in-out rounded-md shadow-sm h-full text-sm' => true,
        'active:bg-neutral-100 dark:bg-neutral-800 dark:active:bg-neutral-900' => true,
        'border-neutral-200 text-neutral-800 hover:text-neutral-500 focus:border-blue-300 active:text-neutral-800 dark:border-neutral-700 dark:focus:border-blue-600 dark:text-neutral-300 dark:hover:text-white dark:focus:border-blue-600 dark:active:text-white' => ! $this->reordering,
        'border-blue-300 text-blue-500 dark:border-blue-600 dark:text-blue-500' => $this->reordering,
    ])
    title="{{ __('Reordering') }}"
    aria-label="{{ __('Reordering') }}"
    x-on:click="$wire.set('reordering', ! $wire.reordering)"
>
    <!-- Icon "queue-list" (outline) from https://heroicons.com -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
    </svg>
</button>
