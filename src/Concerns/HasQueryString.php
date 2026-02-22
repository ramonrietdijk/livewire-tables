<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

trait HasQueryString
{
    protected string $queryStringPrefix = '';

    protected bool $useQueryString = true;

    protected function getQueryStringName(string $name): string
    {
        if ($this->queryStringPrefix !== '') {
            return $this->queryStringPrefix.'_'.$name;
        }

        return $name;
    }
}
