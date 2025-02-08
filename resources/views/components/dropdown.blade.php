@props(['icon', 'label', 'active' => false])

<div class="md:relative z-10" x-data="{ show: false }">
    <x-livewire-table::button
        :title="$label"
        :aria-label="$label"
        :active="$active"
        x-on:click="show = !show"
    >
        {{ $icon ?? '' }}
    </x-livewire-table::button>
    <div
        class="w-full md:w-56 absolute right-0 text-black bg-white mt-2 shadow-xl rounded-sm border border-neutral-200 overflow-y-auto max-h-56 dark:text-white dark:bg-neutral-800 dark:border-neutral-700"
        x-show="show"
        x-on:click.away="show = false"
        style="display: none;">
        {{ $slot }}
    </div>
</div>
