<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator as ConcreteLengthAwarePaginator;

trait HasPagination
{
    public int $perPage = 15;

    /** @var array<int, int> */
    protected array $perPageOptions = [
        15,
        25,
        50,
        75,
        100,
    ];

    /** @var array<string, mixed> */
    protected array $paginationData = [];

    /** @return array<string, mixed> */
    protected function queryStringHasPagination(): array
    {
        if (! $this->useQueryString) {
            return [];
        }

        return [
            'perPage' => [
                'as' => $this->getQueryStringName('perPage'),
            ],
        ];
    }

    public function updatingPaginators(): void
    {
        $this->selectedPage = false;
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    protected function perPage(): int
    {
        $options = $this->perPageOptions();

        if (! in_array($this->perPage, $options, true)) {
            return $options[0];
        }

        return $this->perPage;
    }

    /** @return array<int, int> */
    protected function perPageOptions(): array
    {
        return $this->perPageOptions;
    }

    /** @return array<string, mixed> */
    protected function paginationData(): array
    {
        return $this->paginationData;
    }

    /** @return LengthAwarePaginator<int, covariant Model> */
    protected function paginate(): LengthAwarePaginator
    {
        if ($this->deferLoading && ! $this->initialized) {
            return new ConcreteLengthAwarePaginator([], 0, $this->perPage());
        }

        return $this->appliedQuery()->paginate($this->perPage());
    }
}
