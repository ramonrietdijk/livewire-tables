@props(['icon', 'label'])

<div class="flex gap-3 rounded-md bg-blue-50 dark:bg-blue-900 text-blue-600 dark:text-blue-300 transition">
    <p class="flex items-center gap-2 flex-1 px-3 py-2">
        <x-livewire-table::icon :icon="$icon" class="shrink-0 size-5" />
        {{ $label }}
    </p>
    <div class="flex items-stretch">
        {{ $slot }}
    </div>
</div>
