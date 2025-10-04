@props(['size' => 'md'])

<input
    {{
        $attributes->class([
            'w-full rounded-md border transition',
            'ring-blue-300 dark:ring-blue-400',
            'focus:outline-none focus:ring focus:z-10',
            'bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 active:bg-gray-200 dark:active:bg-gray-600',
            'border-gray-100 dark:border-gray-700 hover:border-gray-200 dark:hover:border-gray-600 focus:border-blue-300 dark:focus:border-blue-400',
            'text-gray-800 dark:text-white',
            'px-3 py-2' => $size === 'md',
            'px-2 py-1' => $size === 'sm',
        ])
    }}
/>
