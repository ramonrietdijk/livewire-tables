<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use RamonRietdijk\LivewireTables\Concerns\HasActions;
use RamonRietdijk\LivewireTables\Concerns\HasColumns;
use RamonRietdijk\LivewireTables\Concerns\HasDeferredLoading;
use RamonRietdijk\LivewireTables\Concerns\HasFilters;
use RamonRietdijk\LivewireTables\Concerns\HasIdentifier;
use RamonRietdijk\LivewireTables\Concerns\HasInitialization;
use RamonRietdijk\LivewireTables\Concerns\HasLink;
use RamonRietdijk\LivewireTables\Concerns\HasModel;
use RamonRietdijk\LivewireTables\Concerns\HasPagination;
use RamonRietdijk\LivewireTables\Concerns\HasPolling;
use RamonRietdijk\LivewireTables\Concerns\HasQuery;
use RamonRietdijk\LivewireTables\Concerns\HasQueryString;
use RamonRietdijk\LivewireTables\Concerns\HasRelations;
use RamonRietdijk\LivewireTables\Concerns\HasReordering;
use RamonRietdijk\LivewireTables\Concerns\HasSearch;
use RamonRietdijk\LivewireTables\Concerns\HasSelect;
use RamonRietdijk\LivewireTables\Concerns\HasSelection;
use RamonRietdijk\LivewireTables\Concerns\HasSession;
use RamonRietdijk\LivewireTables\Concerns\HasSoftDeletes;
use RamonRietdijk\LivewireTables\Concerns\HasSorting;

class LivewireTable extends Component
{
    use HasActions;
    use HasColumns;
    use HasDeferredLoading;
    use HasFilters;
    use HasIdentifier;
    use HasInitialization;
    use HasLink;
    use HasModel;
    use HasPagination;
    use HasPolling;
    use HasQuery;
    use HasQueryString;
    use HasRelations;
    use HasReordering;
    use HasSearch;
    use HasSelect;
    use HasSelection;
    use HasSession;
    use HasSoftDeletes;
    use HasSorting;
    use WithPagination;

    /** @phpstan-var view-string */
    protected string $view = 'livewire-table::livewire.livewire-table';

    public function render(): mixed
    {
        return view($this->view, [
            'paginator' => $this->paginate(),
            'table' => [
                'columns' => $this->resolveColumns(),
                'filters' => $this->resolveFilters(),
                'actions' => $this->resolveActions(),
            ],
            'perPageOptions' => $this->perPageOptions(),
            'pollingOptions' => $this->pollingOptions(),
        ]);
    }
}
