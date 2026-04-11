<x-livewire-table::modal.icon.base
    {{
        $attributes
            ->merge(['icon' => 'exclamation-triangle'])
            ->class('text-red-500 bg-red-50 dark:bg-gray-700')
    }}
/>
