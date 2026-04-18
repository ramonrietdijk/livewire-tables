@script
<script>
    Alpine.data('LivewireTable', () => ({
        modals: [],

        addModal (options) {
            const id = Math.random().toString(36).substring(2)

            this.modals.push({ ...options, id })
        }
    }))

    Alpine.data('LivewireTableAction', (options) => ({
        execute (callback) {
            if (options.confirmation) {
                this.addModal({ ...options.confirmation, callback })
            } else {
                callback()
            }
        },

        ...options,
    }))

    Alpine.data('LivewireTableModal', (options) => ({
        open: false,

        init () {
            this.$nextTick(() => this.show())
        },
        show () {
            this.open = true
        },
        close () {
            this.open = false

            setTimeout(() => {
                const index = this.modals.findIndex(modal => modal.id === options.id)

                if (index >= 0) {
                    this.modals.splice(index, 1)
                }
            }, 1000)
        },
        execute () {
            options.callback()

            this.close()
        },

        ...options,
    }))

    Alpine.data('LivewireTableDropdown', () => ({
        open: false,

        toggle () {
            this.open = ! this.open
        },
        close () {
            this.open = false
        },
    }))

    Alpine.data('LivewireTableRow', (options, $wire) => ({
        dragstart (event) {
            event.dataTransfer.setData('item', options.item)
        },
        drop (event) {
            $wire.call(
                'reorderItem',
                event.dataTransfer.getData('item'),
                options.item,
                event.target.offsetHeight / 2 > event.offsetY
            )
        },

        ...options,
    }))

    Alpine.data('LivewireTableColumn', (options, $wire) => ({
        dragstart (event) {
            event.dataTransfer.setData('code', options.code)
        },
        drop (event) {
            $wire.call(
                'reorderColumn',
                event.dataTransfer.getData('code'),
                options.code,
                event.target.offsetHeight / 2 > event.offsetY
            )
        },

        ...options,
    }))

    Alpine.data('LivewireTableCopy', () => ({
        copied: false,

        copy: async function (text) {
            try {
                await navigator.clipboard.writeText(text)

                this.copied = true

                setTimeout(() => {
                    this.copied = false
                }, 1000)
            } catch (error) {
                console.error(error.message)
            }
        },
    }))
</script>
@endscript
