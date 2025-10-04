@props(['variant' => 'info'])

<button
    {{
        $attributes->merge([
            'type' => 'button',
        ])->class([
            'relative flex items-center px-3 py-2 h-full border cursor-pointer transition',
            'focus:outline-none focus:ring focus:z-10',

            'ring-blue-300 dark:ring-blue-400' => $variant === 'info',
            'bg-blue-50 dark:bg-blue-900 hover:bg-blue-100 dark:hover:bg-blue-700 active:bg-blue-100 dark:active:bg-blue-700' => $variant === 'info',
            'border-blue-50 dark:border-blue-900 hover:border-blue-100 dark:hover:border-blue-700 focus:border-blue-300 dark:focus:border-blue-400' => $variant === 'info',
            'text-blue-600 dark:text-blue-300 hover:text-blue-700 dark:hover:text-blue-200 active:text-blue-700 dark:active:text-blue-200' => $variant === 'info',
        ])
    }}
>
    {{ $slot }}
</button>
