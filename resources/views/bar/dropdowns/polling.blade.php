@if(count($pollingOptions) > 0)
    <x-livewire-table::dropdown icon="heroicon-o-arrow-path" label="{{ __('Polling') }}">
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
                    class="w-full border border-neutral-200 rounded-md shadow-sm outline-none bg-white text-black focus:border-blue-300 mr-auto px-3 py-2 font-normal transition ease-in-out dark:bg-neutral-900 dark:border-neutral-700 dark:focus:border-blue-600 dark:text-white"
                    wire:model="polling">
                    @foreach($pollingOptions as $key => $value)
                        <option value="{{ $key }}">@lang($value)</option>
                    @endforeach
                </select>
            </div>
        </div>
    </x-livewire-table::dropdown>
@endif
