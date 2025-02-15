<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Actions;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Enumerable;
use RamonRietdijk\LivewireTables\Actions\Concerns\CanBeStandalone;
use RamonRietdijk\LivewireTables\Concerns\HasMetadata;
use RamonRietdijk\LivewireTables\Concerns\Makeable;

abstract class BaseAction
{
    use CanBeStandalone;
    use HasMetadata;
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

    /** @param  Enumerable<int, covariant Model>  $models */
    public function execute(Enumerable $models): mixed
    {
        $callback = $this->callback();

        if ($callback === null) {
            return null;
        }

        return call_user_func($callback, $models);
    }
}
