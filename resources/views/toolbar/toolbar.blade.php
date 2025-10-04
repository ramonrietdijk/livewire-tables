@php($actions = $this->resolveActions())

<div class="bg-white dark:bg-gray-800 flex items-center flex-wrap gap-3 px-2 py-2 rounded-t-md flex-1 border-b border-gray-200 dark:border-gray-700 transition">
    @include('livewire-table::toolbar.loader')
    @includeWhen($this->canSearch(), 'livewire-table::toolbar.search')
    @includeWhen($this->canClearSearch(), 'livewire-table::toolbar.buttons.clear-search')
    @include('livewire-table::toolbar.notification')
    <div class="flex items-center gap-1 ml-auto">
        @includeWhen($this->useReordering, 'livewire-table::toolbar.buttons.reordering')
        @includeWhen($actions->isNotEmpty(), 'livewire-table::toolbar.dropdowns.actions')
        @include('livewire-table::toolbar.dropdowns.configuration')
    </div>
</div>
