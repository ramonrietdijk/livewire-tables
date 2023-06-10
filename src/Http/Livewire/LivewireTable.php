<?php

namespace RamonRietdijk\LivewireTables\Http\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;
use RamonRietdijk\LivewireTables\Columns\BaseColumn;
use RamonRietdijk\LivewireTables\Concerns\HasActions;
use RamonRietdijk\LivewireTables\Concerns\HasColumns;
use RamonRietdijk\LivewireTables\Concerns\HasFilters;
use RamonRietdijk\LivewireTables\Concerns\HasPagination;
use RamonRietdijk\LivewireTables\Concerns\HasPolling;
use RamonRietdijk\LivewireTables\Concerns\HasQueryString;
use RamonRietdijk\LivewireTables\Concerns\HasRelations;
use RamonRietdijk\LivewireTables\Concerns\HasSearch;
use RamonRietdijk\LivewireTables\Concerns\HasSelect;
use RamonRietdijk\LivewireTables\Concerns\HasSelection;
use RamonRietdijk\LivewireTables\Concerns\HasSoftDeletes;
use RamonRietdijk\LivewireTables\Concerns\HasSorting;

class LivewireTable extends Component
{
    use WithPagination;
    use HasActions;
    use HasColumns;
    use HasFilters;
    use HasPagination;
    use HasPolling;
    use HasQueryString;
    use HasRelations;
    use HasSearch;
    use HasSelect;
    use HasSelection;
    use HasSoftDeletes;
    use HasSorting;

    protected string $model = Model::class;

    /** @var array <int|string, string> */
    protected $listeners = [
        'refreshLivewireTable' => '$refresh',
    ];

    public function mount(): void
    {
        $this->initialize();
    }

    protected function initialize(): void
    {
        /** @var array<int, string> $columns */
        $columns = $this->resolveColumns()
            ->map(fn (BaseColumn $column): string => $column->code())
            ->toArray();

        $this->columns = $columns;
    }

    protected function link(Model $model): ?string
    {
        return null;
    }

    protected function model(): Model
    {
        /** @var Model $model */
        $model = $this->model;

        return new $model;
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
