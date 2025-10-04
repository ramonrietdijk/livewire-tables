@props(['size' => 'md', 'active' => false, 'dot' => false])

<button
    {{
        $attributes->merge([
            'type' => 'button',
        ])->class([
            'relative flex items-center rounded-md border cursor-pointer transition',
            'ring-blue-300 dark:ring-blue-400',
            'focus:outline-none focus:ring focus:z-10',
            'bg-white dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 active:bg-gray-200 dark:active:bg-gray-700',
            'border-white dark:border-gray-800 hover:border-gray-200 dark:hover:border-gray-700 focus:border-blue-300 dark:focus:border-blue-400',
            'text-gray-700 dark:text-gray-200 hover:text-gray-800 dark:hover:text-white active:text-gray-800 dark:active:text-white' => ! $active,
            'text-blue-500' => $active,
            'px-3 py-2' => $size === 'md',
            'px-2 py-1' => $size === 'sm',
        ])
    }}
>
    {{ $slot }}
    @if($dot)
        <span class="absolute right-2 top-1 rounded-full shadow-xs bg-blue-500 block size-2"></span>
    @endif
</button>
