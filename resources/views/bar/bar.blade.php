<div class="flex flex-col gap-3">
    <div class="flex flex-col lg:flex-row gap-3">
        @includeWhen($this->canSearch(), 'livewire-table::bar.search')
        <div class="justify-center items-center w-full border-y border-transparent" wire:loading.flex>
            <span class="inline-block border border-4 border-blue-500 border-r-transparent motion-safe:animate-spin rounded-full my-2 p-2"></span>
        </div>
        @include('livewire-table::bar.selection')
        <div class="flex gap-3 ml-auto">
            @includeWhen($this->useReordering, 'livewire-table::bar.buttons.reordering')
            @include('livewire-table::bar.dropdowns.polling')
            @include('livewire-table::bar.dropdowns.columns')
            @include('livewire-table::bar.dropdowns.filters')
            @include('livewire-table::bar.dropdowns.actions')
            @include('livewire-table::bar.dropdowns.trashed')
            <select wire:model.live="perPage"
                    class="border border-neutral-200 shadow-xs rounded-md outline-hidden focus:border-blue-300 px-3 py-2 bg-white text-black transition ease-in-out dark:bg-neutral-800 dark:border-neutral-700 dark:focus:border-blue-600 dark:text-white">
                @foreach($perPageOptions as $perPage)
                    <option value="{{ $perPage }}">{{ $perPage }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
