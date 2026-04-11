@props(['size' => 'md', 'dot' => false, 'active' => false])

<x-livewire-table::button.base :$size :$dot
    {{
        $attributes->class([
            'ring-blue-300 dark:ring-blue-400',
            'bg-white dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 active:bg-gray-200 dark:active:bg-gray-700',
            'border-white dark:border-gray-800 hover:border-gray-200 dark:hover:border-gray-700 focus:border-blue-300 dark:focus:border-blue-400',
            'text-gray-700 dark:text-gray-200 hover:text-gray-800 dark:hover:text-white active:text-gray-800 dark:active:text-white' => ! $active,
            'text-blue-500' => $active,
        ])
    }}
>
    {{ $slot }}
</x-livewire-table::button.base>
