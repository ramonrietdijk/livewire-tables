<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Enums\TrashedMode;

trait HasSoftDeletes
{
    public string $trashed = 'withoutTrashed';

    /** @return array<string, mixed> */
    protected function queryStringHasSoftDeletes(): array
    {
        if (! $this->useQueryString) {
            return [];
        }

        return [
            'trashed' => [
                'as' => $this->getQueryStringName('trashed'),
            ],
        ];
    }

    protected function hasSoftDeletes(): bool
    {
        return method_exists($this->model(), 'trashed');
    }

    /** @param  Builder<covariant Model>  $builder */
    protected function applySoftDeletes(Builder $builder): static
    {
        if (! $this->hasSoftDeletes()) {
            return $this;
        }

        $trashedMode = TrashedMode::from($this->trashed);

        if ($trashedMode === TrashedMode::WithoutTrashed) {
            $builder->withoutTrashed(); // @phpstan-ignore-line
        }

        if ($trashedMode === TrashedMode::WithTrashed) {
            $builder->withTrashed(); // @phpstan-ignore-line
        }

        if ($trashedMode === TrashedMode::OnlyTrashed) {
            $builder->onlyTrashed(); // @phpstan-ignore-line
        }

        return $this;
    }
}
