<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasModel
{
    protected string $model = Model::class;

    protected function model(): Model
    {
        return app($this->model);
    }

    protected function getModelKey(Model $model): mixed
    {
        return $model->getKey();
    }
}
