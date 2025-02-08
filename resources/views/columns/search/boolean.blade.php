<div class="px-3 py-1">
    <select
        class="min-w-full border border-neutral-200 rounded-md shadow-xs outline-hidden bg-white text-black focus:border-blue-300 mr-auto px-2 py-1 font-normal transition ease-in-out dark:bg-neutral-900 dark:border-neutral-700 dark:focus:border-blue-600 dark:text-white h-8"
        wire:model.live="search.{{ $column->code() }}">
        <option value="">&mdash;</option>
        <option value="1">@lang('Yes')</option>
        <option value="0">@lang('No')</option>
    </select>
</div>
