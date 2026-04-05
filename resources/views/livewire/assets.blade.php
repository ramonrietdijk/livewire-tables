@assets
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('LivewireTable', () => ({
            //
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
    })
</script>
@endassets
