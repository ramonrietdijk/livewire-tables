@props(['size' => 'md', 'dot' => false])

<x-livewire-table::button.base :$size :$dot
    {{
        $attributes->class([
            'ring-blue-300 dark:ring-blue-400',
            'bg-blue-600 dark:bg-blue-700 hover:bg-blue-500 dark:hover:bg-blue-600 active:bg-blue-500 dark:active:bg-blue-600',
            'border-blue-600 dark:border-blue-700 hover:border-blue-500 dark:hover:border-blue-600 focus:border-blue-300 dark:focus:border-blue-400',
            'text-white dark:text-white hover:text-white dark:hover:text-white active:text-white dark:active:text-white',
        ])
    }}
>
    {{ $slot }}
</x-livewire-table::button.base>
