<div
    x-data="LivewireTableModal(modal)"
    x-show="open"
    x-transition.opacity
    x-on:click.self="close"
    x-on:keydown.escape.window="close"
    class="fixed z-50 inset-0 flex items-start lg:items-center p-5 bg-black/50 dark:bg-black/75 transition"
>
    <div
        x-show="open"
        x-transition
        x-on:click.self="close"
        class="flex-1 max-w-xl w-full bg-white dark:bg-gray-800 mx-auto rounded-md shadow-xl transition"
    >
        <div class="flex items-start p-5 gap-5">
            {{ $icon }}
            <div>
                <span class="block mb-1 font-bold text-gray-600 dark:text-gray-300 transition">{{ $title }}</span>
                <p class="text-sm text-gray-500 dark:text-gray-400 transition">{{ $body }}</p>
            </div>
        </div>
        <div class="border-t border-gray-200 dark:border-gray-700 transition rounded-b-md flex gap-3 px-5 py-3 justify-end">
            {{ $actions }}
        </div>
    </div>
</div>
