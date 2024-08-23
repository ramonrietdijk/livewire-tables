<?php

namespace RamonRietdijk\LivewireTables\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator as ConcreteLengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use RamonRietdijk\LivewireTables\Concerns\HasActions;
use RamonRietdijk\LivewireTables\Concerns\HasColumns;
use RamonRietdijk\LivewireTables\Concerns\HasDeferredLoading;
use RamonRietdijk\LivewireTables\Concerns\HasFilters;
use RamonRietdijk\LivewireTables\Concerns\HasIdentifier;
use RamonRietdijk\LivewireTables\Concerns\HasInitialization;
use RamonRietdijk\LivewireTables\Concerns\HasPagination;
use RamonRietdijk\LivewireTables\Concerns\HasPolling;
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
    use HasPagination;
    use HasPolling;
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

    protected string $model = Model::class;

    /** @var mixed */
    protected $listeners = [
        'refreshLivewireTable' => '$refresh',
    ];

    protected function link(Model $model): ?string
    {
        return null;
    }

    protected function model(): Model
    {
        /** @var Model $model */
        $model = $this->model;

        return app($model);
    }

    /** @return Builder<Model> */
    protected function query(): Builder
    {
        return $this->model()->query();
    }

    /** @return Builder<Model> */
    protected function appliedQuery(): Builder
    {
        $query = $this->query();

        $this
            ->applySelect($query)
            ->applySoftDeletes($query)
            ->applyRelations($query)
            ->applyGlobalSearch($query)
            ->applyColumnSearch($query)
            ->applyFilters($query)
            ->applySorting($query);

        return $query;
    }

    /** @return LengthAwarePaginator<Model> */
    protected function paginate(): LengthAwarePaginator
    {
        if ($this->deferLoading && ! $this->initialized) {
            return new ConcreteLengthAwarePaginator([], 0, $this->perPage());
        }

        return $this->appliedQuery()->paginate($this->perPage());
    }

    public function render(): View
    {
        return view('livewire-table::livewire.livewire-table', [
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
