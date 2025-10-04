<x-livewire-table::button
    size="sm"
    :title="__('Copy')"
    :aria-label="__('Copy')"
    class="!absolute top-1 right-1 z-10 opacity-0 group-hover/column:opacity-100 cursor-pointer"
    x-on:click.stop="copy"
    x-data="{
        copied: false,
        copy: async function () {
            try {
                const text = $refs.content.innerText;

                await navigator.clipboard.writeText(text);

                this.copied = true;

                setTimeout(() => this.copied = false, 1000);
            } catch (error) {
                console.error(error.message);
            }
        }
    }"
>
    <template x-if="! copied">
        <x-livewire-table::icon class="size-5" icon="clipboard-document" />
    </template>
    <template x-if="copied">
        <x-livewire-table::icon class="size-5" icon="clipboard-document-check" />
    </template>
</x-livewire-table::button>
