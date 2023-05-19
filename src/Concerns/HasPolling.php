<?php

namespace RamonRietdijk\LivewireTables\Concerns;

trait HasPolling
{
    public string $polling = '';

    /** @var array<string, string> */
    protected array $pollingOptions = [
        '' => 'None',
        '10s' => 'Every 10 seconds',
    ];

    protected function polling(): string
    {
        if (! array_key_exists($this->polling, $this->pollingOptions)) {
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
