@props(['label'])

<div class="px-4 py-3 transition">
    <label class="flex flex-col gap-0.5">
        <span class="block uppercase text-xs font-bold whitespace-nowrap truncate text-gray-400 dark:text-gray-500 transition" title="{{ $label }}">{{ $label }}</span>
        {{ $slot }}
    </label>
</div>
