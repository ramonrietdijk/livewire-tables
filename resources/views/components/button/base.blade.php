@props(['size' => 'md', 'dot' => false])

<button
    {{
        $attributes->merge([
            'type' => 'button',
        ])->class([
            'relative flex items-center rounded-md border cursor-pointer transition',
            'focus:outline-none focus:ring focus:z-10',
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
