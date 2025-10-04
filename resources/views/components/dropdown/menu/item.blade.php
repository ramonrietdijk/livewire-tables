@props(['label', 'icon' => null, 'navigate' => null, 'dot' => false])

<li>
    <button
        {{
            $attributes->merge([
                'type' => 'button',
            ])->class([
                'flex items-center gap-3 w-full px-4 py-2 text-left relative border group/item cursor-pointer transition disabled:cursor-not-allowed',
                'ring-blue-300 dark:ring-blue-400',
                'focus:outline-none focus:ring focus:z-10',
                'hover:bg-gray-100 dark:hover:bg-gray-700 active:bg-gray-100 dark:active:bg-gray-700 disabled:hover:bg-white dark:disabled:hover:bg-gray-800 disabled:active:bg-white dark:disabled:active:bg-gray-800',
                'border-white dark:border-gray-800 hover:border-gray-100 dark:hover:border-gray-700 focus:border-blue-300 dark:focus:border-blue-400 disabled:hover:border-white dark:disabled:hover:border-gray-800',
                'text-gray-700 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white active:text-gray-800 dark:active:text-white disabled:text-gray-400 dark:disabled:text-gray-500 disabled:hover:text-gray-400 dark:disabled:hover:text-gray-500',
            ])->when($navigate, fn ($bag) => $bag->merge([
                'x-data' => Js::from(['navigate' => $navigate]),
                'x-on:click' => 'current = navigate',
            ]))
        }}
    >
        @if($icon)
            <x-livewire-table::icon class="text-gray-500 dark:text-gray-400 group-hover/item:text-gray-600 dark:group-hover/item:text-white group-active/item:text-gray-600 dark:group-active/item:text-white transition size-5" :icon="$icon" />
        @endif

        <span class="relative flex-1">
            {{ $label }}
        </span>

        @if($navigate)
            <x-livewire-table::icon class="text-gray-500 dark:text-gray-400 group-hover/item:text-gray-600 dark:group-hover/item:text-white group-active/item:text-gray-600 dark:group-active/item:text-white transition size-5" icon="chevron-right" />
        @endif

        @if($dot)
            <span class="absolute left-8 top-2 rounded-full shadow-xs bg-blue-500 block size-2"></span>
        @endif
    </button>
</li>
