<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasLink
{
    protected bool $useNavigate = false;

    protected function link(Model $model): ?string
    {
        return null;
    }
}
