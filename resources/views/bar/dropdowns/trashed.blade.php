@if($this->hasSoftDeletes())
    <x-livewire-table::dropdown label="{{ __('Trashed') }}">
        <x-slot name="icon">
            <!-- Icon "eye" (outline) from https://heroicons.com -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </x-slot>
        <span
            class="flex px-3 py-2 font-bold text-xs uppercase border-b border-neutral-200 bg-neutral-50 text-neutral-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
            @lang('Trashed')
        </span>
        <div class="flex flex-col">
            <div class="px-3 py-2">
                <span class="block whitespace-nowrap truncate" title="@lang('Show')">
                    @lang('Show')
                </span>
                <select
                    class="w-full border border-neutral-200 rounded-md shadow-xs outline-hidden bg-white text-black focus:border-blue-300 mr-auto px-3 py-2 font-normal transition ease-in-out dark:bg-neutral-900 dark:border-neutral-700 dark:focus:border-blue-600 dark:text-white"
                    wire:model.live="trashed">
                    <option value="withoutTrashed">@lang('Without Trashed')</option>
                    <option value="withTrashed">@lang('With Trashed')</option>
                    <option value="onlyTrashed">@lang('Only Trashed')</option>
                </select>
            </div>
        </div>
    </x-livewire-table::dropdown>
@endif
