@props(['size' => 'md', 'dot' => false])

<x-livewire-table::button.base :$size :$dot
    {{
        $attributes->class([
            'ring-red-300 dark:ring-red-400',
            'bg-red-600 dark:bg-red-700 hover:bg-red-500 dark:hover:bg-red-600 active:bg-red-500 dark:active:bg-red-600',
            'border-red-600 dark:border-red-700 hover:border-red-500 dark:hover:border-red-600 focus:border-red-300 dark:focus:border-red-400',
            'text-white dark:text-white hover:text-white dark:hover:text-white active:text-white dark:active:text-white',
        ])
    }}
>
    {{ $slot }}
</x-livewire-table::button.base>
