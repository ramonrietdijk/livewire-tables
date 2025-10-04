<label class="flex items-center relative">
    <input
        {{
            $attributes
                ->merge(['type' => 'checkbox'])
                ->class([
                    'rounded-md size-5 cursor-pointer shadow-sm appearance-none border peer transition',
                    'ring-blue-300 dark:ring-blue-400',
                    'focus:outline-none focus:ring',
                    'bg-white dark:bg-gray-900 checked:bg-blue-500',
                    'border-gray-300 dark:border-gray-600 focus:border-blue-300 dark:focus:border-blue-400 checked:border-blue-500',
                    'text-gray-800 dark:text-white',
                ])
        }}
    />
    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-0.5 left-0.5 transform pointer-events-none">
        <x-livewire-table::icon icon="check" class="size-4" />
    </span>
</label>
