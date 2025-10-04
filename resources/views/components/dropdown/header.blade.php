@props(['label', 'icon', 'navigate' => null])

<header class="flex items-center border-b border-gray-200 dark:border-gray-700 transition">
    <button
        {{
            $attributes->merge([
                'type' => 'button',
            ])->class([
                'flex items-center gap-3 w-full text-sm px-4 py-3 border transition',
                'bg-gray-50 dark:bg-gray-700',
                'border-gray-50 dark:border-gray-700',
                'text-gray-600 dark:text-gray-300',
                'cursor-pointer' => $navigate,
                'ring-blue-300 dark:ring-blue-400' => $navigate,
                'focus:outline-none focus:ring focus:z-10' => $navigate,
                'hover:bg-gray-100 dark:hover:bg-gray-600 active:bg-gray-100 dark:active:bg-gray-600' => $navigate,
                'hover:border-gray-100 dark:hover:border-gray-600 focus:border-blue-300 dark:focus:border-blue-400' => $navigate,
                'hover:text-gray-700 dark:hover:text-white active:text-gray-700 dark:active:text-white' => $navigate,
                'rounded-t-md' => ! $slot->hasActualContent(),
                'rounded-tl-md' => $slot->hasActualContent(),
            ])->when($navigate, fn ($bag) => $bag->merge([
                'x-data' => Js::from(['navigate' => $navigate]),
                'x-on:click' => 'current = navigate',
            ]), fn ($bag) => $bag->merge([
                'disabled' => '',
            ]))
        }}
    >
        <x-livewire-table::icon class="text-gray-500 dark:text-gray-400 size-5 transition" :icon="$icon" />
        <span>{{ $label }}</span>
    </button>
    {{ $slot }}
</header>
