<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Actions;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Actions\Concerns\CanBeRun;
use RamonRietdijk\LivewireTables\Actions\Concerns\HasSelection;
use RamonRietdijk\LivewireTables\Actions\Concerns\HasType;
use RamonRietdijk\LivewireTables\Concerns\CanBeSeen;
use RamonRietdijk\LivewireTables\Concerns\HasMetadata;
use RamonRietdijk\LivewireTables\Concerns\Makeable;

abstract class BaseAction
{
    use CanBeRun;
    use CanBeSeen;
    use HasMetadata;
    use HasSelection;
    use HasType;
    use Makeable;

    public function __construct(
        protected string $label,
        protected string $code,
        protected ?Closure $callback = null
    ) {}

    public function label(): string
    {
        return $this->label;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function callback(): ?Closure
    {
        return $this->callback;
    }

    /** @param  Collection<int, covariant Model>  $models */
    public function execute(Collection $models): mixed
    {
        $callback = $this->callback();

        if ($callback === null) {
            return null;
        }

        return call_user_func($callback, $models);
    }
}
