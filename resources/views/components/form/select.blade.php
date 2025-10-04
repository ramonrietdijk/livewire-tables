@props(['size' => 'md'])

<label class="block relative">
    <select
        {{
            $attributes->class([
                'w-full rounded-md border appearance-none transition',
                'ring-blue-300 dark:ring-blue-400',
                'focus:outline-none focus:ring focus:z-10',
                'bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 active:bg-gray-200 dark:active:bg-gray-600',
                'border-gray-100 dark:border-gray-700 hover:border-gray-200 dark:hover:border-gray-600 focus:border-blue-300 dark:focus:border-blue-400',
                'text-gray-800 dark:text-white',
                'pl-3 pr-10 py-2' => $size === 'md',
                'pl-2 pr-6 py-1' => $size === 'sm',
            ])
        }}
    >
        {{ $slot }}
    </select>
    @if($size === 'sm')
        <x-livewire-table::icon icon="chevron-down" class="pointer-events-none size-3 absolute right-2 top-3 text-gray-800 dark:text-white transition" />
    @elseif($size === 'md')
        <x-livewire-table::icon icon="chevron-down" class="pointer-events-none size-4.5 absolute right-3 top-3 text-gray-800 dark:text-white transition" />
    @endif
</label>
