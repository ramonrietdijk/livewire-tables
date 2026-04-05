<x-livewire-table::button
    size="sm"
    :title="__('Copy')"
    :aria-label="__('Copy')"
    class="absolute! top-1 right-1 z-10 opacity-0 group-hover/column:opacity-100 cursor-pointer"
    x-data="LivewireTableCopy"
    x-on:click.stop="copy($refs.content.innerText)"
>
    <template x-if="! copied">
        <x-livewire-table::icon class="size-5" icon="clipboard-document" />
    </template>
    <template x-if="copied">
        <x-livewire-table::icon class="size-5" icon="clipboard-document-check" />
    </template>
</x-livewire-table::button>
