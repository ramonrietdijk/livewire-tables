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

    public function updatingPage(): void
    {
        $this->selectPage = false;
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    protected function perPage(): int
    {
        if (! in_array($this->perPage, $this->perPageOptions)) {
            return $this->perPageOptions[0];
        }

        return $this->perPage;
    }

    /** @return array<int, int> */
    protected function perPageOptions(): array
    {
        return $this->perPageOptions;
    }
}
