<?php

namespace RamonRietdijk\LivewireTables\Columns;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use RamonRietdijk\LivewireTables\Columns\Concerns\CanBeClickable;
use RamonRietdijk\LivewireTables\Columns\Concerns\CanBeRaw;
use RamonRietdijk\LivewireTables\Columns\Concerns\HasFooter;
use RamonRietdijk\LivewireTables\Columns\Concerns\HasHeader;
use RamonRietdijk\LivewireTables\Columns\Concerns\HasSearch;
use RamonRietdijk\LivewireTables\Columns\Concerns\HasSorting;
use RamonRietdijk\LivewireTables\Columns\Concerns\HasValue;
use RamonRietdijk\LivewireTables\Concerns\CanBeComputed;
use RamonRietdijk\LivewireTables\Concerns\CanBeQualified;
use RamonRietdijk\LivewireTables\Concerns\HasMetadata;
use RamonRietdijk\LivewireTables\Concerns\Makeable;

abstract class BaseColumn
{
    use CanBeComputed;
    use CanBeQualified;
    use CanBeClickable;
    use CanBeRaw;
    use HasFooter;
    use HasHeader;
    use HasSearch;
    use HasSorting;
    use HasValue;
    use HasMetadata;
    use Makeable;

    protected string $code;

    protected ?string $column;

    protected string $view = 'livewire-table::columns.content.default';

    public function __construct(
        protected string $label,
        string|Closure $column = null,
        string $code = null
    ) {
        if (is_string($column)) {
            $this->column = $column;
            $this->code = $code ?? Str::of($column)->replace('.', '_')->toString();
        } else {
            $this->column = null;
            $this->code = $code ?? md5($label);
            $this->displayUsing = $column;
            $this->computed = true;
        }
    }

    public function label(): string
    {
        return $this->label;
    }

    public function column(): ?string
    {
        return $this->column;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function render(Model $model): mixed
    {
        $value = $this->resolveValue($model);

        return view($this->view, [
            'column' => $this,
            'value' => $value,
        ]);
    }
}
