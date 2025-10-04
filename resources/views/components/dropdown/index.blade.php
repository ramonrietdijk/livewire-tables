@props(['body', 'current'])

<div
    {{ $attributes }}
    x-data="{
        open: false,
        toggle() {
            this.open = ! this.open;
        },
        close() {
            this.open = false;
        },
    }"
    x-on:click.away="close"
    x-on:keydown.escape.window="close"
>
    {{ $slot }}
    <div class="relative z-30">
        <div
            x-data="@js(['current' => $current])"
            x-show="open"
            x-transition
            x-cloak
            class="absolute top-1 right-0 bg-white dark:bg-gray-800 shadow-md rounded-md w-64 border border-gray-300 dark:border-gray-600 transition"
        >
            {{ $body }}
        </div>
    </div>
</div>
