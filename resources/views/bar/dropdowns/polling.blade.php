@if(count($pollingOptions) > 0)
    <x-livewire-table::dropdown label="{{ __('Polling') }}">
        <x-slot name="icon">
            <!-- Icon "arrow-path" (outline) from https://heroicons.com -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
        </x-slot>
        <span
            class="flex px-3 py-2 font-bold text-xs uppercase border-b border-neutral-200 bg-neutral-50 text-neutral-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
            @lang('Polling')
        </span>
        <div class="flex flex-col">
            <div class="px-3 py-2">
                <span class="block whitespace-nowrap truncate" title="@lang('Refresh records')">
                    @lang('Refresh records')
                </span>
                <select
                    class="w-full border border-neutral-200 rounded-md shadow-xs outline-hidden bg-white text-black focus:border-blue-300 mr-auto px-3 py-2 font-normal transition ease-in-out dark:bg-neutral-900 dark:border-neutral-700 dark:focus:border-blue-600 dark:text-white"
                    wire:model.live="polling">
                    @foreach($pollingOptions as $key => $value)
                        <option value="{{ $key }}">@lang($value)</option>
                    @endforeach
                </select>
            </div>
        </div>
    </x-livewire-table::dropdown>
@endif
