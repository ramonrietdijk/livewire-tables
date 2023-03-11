<?php

namespace RamonRietdijk\LivewireTables\Filters;

use Closure;
use Illuminate\Support\Str;
use RamonRietdijk\LivewireTables\Concerns\CanBeComputed;
use RamonRietdijk\LivewireTables\Concerns\CanBeQualified;
use RamonRietdijk\LivewireTables\Concerns\HasMetadata;
use RamonRietdijk\LivewireTables\Concerns\Makeable;
use RamonRietdijk\LivewireTables\Filters\Concerns\HasFilter;

abstract class BaseFilter
{
    use CanBeComputed;
    use CanBeQualified;
    use HasFilter;
    use HasMetadata;
    use Makeable;

    protected string $code;

    protected ?string $column;

    protected string $view = 'livewire-table::filters.filter';

    public function __construct(
        protected string $label,
        string|Closure $column = null,
        ?string $code = null
    ) {
        if (is_string($column)) {
            $this->column = $column;
            $this->code = $code ?? Str::of($column)->replace('.', '_')->toString();
        } else {
            $this->column = null;
            $this->code = $code ?? md5($label);
            $this->filterUsing = $column;
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

    public function render(): mixed
    {
        return view($this->view, [
            'filter' => $this,
        ]);
    }
}
