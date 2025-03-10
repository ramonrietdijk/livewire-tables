<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

trait HasPolling
{
    public string $polling = '';

    /** @var array<string, string> */
    protected array $pollingOptions = [];

    /** @return array<string, mixed> */
    protected function queryStringHasPolling(): array
    {
        if (! $this->useQueryString) {
            return [];
        }

        return [
            'polling' => [
                'as' => $this->getQueryStringName('polling'),
            ],
        ];
    }

    protected function polling(): string
    {
        if (! array_key_exists($this->polling, $this->pollingOptions())) {
            return '';
        }

        return $this->polling;
    }

    /** @return array<string, string> */
    protected function pollingOptions(): array
    {
        return $this->pollingOptions;
    }
}
