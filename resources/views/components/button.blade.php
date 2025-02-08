@props(['active' => false])

<button
    {{
        $attributes->class([
            'flex items-center gap-1 relative px-3 py-2 bg-white border transition ease-in-out rounded-md shadow-xs h-full text-sm' => true,
            'active:bg-neutral-100 dark:bg-neutral-800 dark:active:bg-neutral-900' => true,
            'border-neutral-200 text-neutral-800 hover:text-neutral-500 focus:border-blue-300 active:text-neutral-800 dark:border-neutral-700 dark:focus:border-blue-600 dark:text-neutral-300 dark:hover:text-white dark:focus:border-blue-600 dark:active:text-white' => ! $active,
            'border-blue-300 text-blue-500 dark:border-blue-600 dark:text-blue-500' => $active,
        ])
    }}
>
    {{ $slot }}
    @if ($active)
        <span class="absolute -right-1 -top-1 rounded-full shadow-xs bg-blue-500 dark:bg-blue-600 block size-2.5"></span>
    @endif
</button>
