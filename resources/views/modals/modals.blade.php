<template x-teleport="body">
    <template x-for="modal of modals" :key="modal.id">
        <x-livewire-table::modal>
            <x-slot:icon>
                <template x-if="modal.type === 'info'">
                    <x-livewire-table::modal.icon.info />
                </template>
                <template x-if="modal.type === 'danger'">
                    <x-livewire-table::modal.icon.danger />
                </template>
            </x-slot:icon>
            <x-slot:title>
                <span x-text="modal.title"></span>
            </x-slot:title>
            <x-slot:body>
                <span x-text="modal.body"></span>
            </x-slot:body>
            <x-slot:actions>
                <x-livewire-table::button x-on:click.prevent="close">
                    <span x-text="modal.cancel"></span>
                </x-livewire-table::button>
                <template x-if="modal.type === 'info'">
                    <x-livewire-table::button.info x-on:click.prevent="execute">
                        <span x-text="modal.run"></span>
                    </x-livewire-table::button.info>
                </template>
                <template x-if="modal.type === 'danger'">
                    <x-livewire-table::button.danger x-on:click.prevent="execute">
                        <span x-text="modal.run"></span>
                    </x-livewire-table::button.danger>
                </template>
            </x-slot:actions>
        </x-livewire-table::modal>
    </template>
</template>
