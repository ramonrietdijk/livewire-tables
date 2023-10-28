<?php

namespace RamonRietdijk\LivewireTables\Concerns;

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

        if (! in_array($this->perPage, $options)) {
            return $options[0];
        }

        return $this->perPage;
    }

    /** @return array<int, int> */
    protected function perPageOptions(): array
    {
        return $this->perPageOptions;
    }
}
