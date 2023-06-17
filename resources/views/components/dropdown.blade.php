@props(['icon', 'label', 'count' => 0])

<div class="md:relative z-10" x-data="{ show: false }">
    <button
        class="flex items-center gap-1 px-3 py-2 bg-white border border-neutral-200 text-neutral-800 hover:text-neutral-500 focus:border-blue-300 active:bg-neutral-100 active:text-neutral-800 transition ease-in-out rounded-md shadow-sm h-full text-sm dark:bg-neutral-800 dark:border-neutral-700 dark:focus:border-blue-600 dark:text-neutral-300 dark:hover:text-white dark:focus:border-blue-600 dark:active:bg-neutral-900 dark:active:text-white"
        @if(isset($label))
            title="{{ $label }}"
            aria-label="{{ $label }}"
        @endif
        x-on:click="show = !show"
    >
        {{ $icon ?? '' }}
        @if($count > 0)
            <span class="bg-blue-500 text-white rounded-full px-2">{{ $count }}</span>
        @endif
    </button>
    <div
        class="w-full md:w-56 absolute right-0 text-black bg-white mt-2 shadow-xl rounded border border-neutral-200 overflow-y-auto max-h-56 dark:text-white dark:bg-neutral-800 dark:border-neutral-700"
        x-show="show"
        x-on:click.away="show = false"
        style="display: none;">
        {{ $slot }}
    </div>
</div>
