<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Actions;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use RamonRietdijk\LivewireTables\Actions\Concerns\CanBeRun;
use RamonRietdijk\LivewireTables\Actions\Concerns\HasKind;
use RamonRietdijk\LivewireTables\Actions\Concerns\HasSelection;
use RamonRietdijk\LivewireTables\Actions\Concerns\HasType;
use RamonRietdijk\LivewireTables\Concerns\CanBeSeen;
use RamonRietdijk\LivewireTables\Concerns\HasMetadata;
use RamonRietdijk\LivewireTables\Concerns\Makeable;
use RamonRietdijk\LivewireTables\Enums\ActionKind;

abstract class BaseAction
{
    use CanBeRun;
    use CanBeSeen;
    use HasKind;
    use HasMetadata;
    use HasSelection;
    use HasType;
    use Makeable;

    protected string $code;

    protected ?string $script = null;

    protected ?Closure $callback = null;

    public function __construct(
        protected string $label,
        string|Closure $callback,
        ?string $code = null,
    ) {
        if (is_string($callback)) {
            $this->script = $callback;
            $this->kind = ActionKind::Script;
        } else {
            $this->callback = $callback;
            $this->kind = ActionKind::Callback;
        }

        $this->code = $code ?? Str::snake($label);
    }

    public function label(): string
    {
        return $this->label;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function script(): ?string
    {
        return $this->script;
    }

    public function callback(): ?Closure
    {
        return $this->callback;
    }

    /** @param  Collection<int, covariant Model>  $models */
    public function execute(Collection $models): mixed
    {
        if (($callback = $this->callback()) !== null) {
            return call_user_func($callback, $models);
        }

        return null;
    }
}
