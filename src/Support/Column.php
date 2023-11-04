<?php

namespace RamonRietdijk\LivewireTables\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use RamonRietdijk\LivewireTables\Concerns\Makeable;

class Column
{
    use Makeable;

    public function __construct(
        protected string $column
    ) {
    }

    public function column(): Stringable
    {
        return Str::of($this->column);
    }

    public function name(): string
    {
        return $this->column()->explode('.')->last() ?? '';
    }

    public function hasRelation(): bool
    {
        return $this->column()->explode('.')->count() > 1;
    }

    public function relation(string $glue = '.'): string
    {
        return $this->column()->explode('.')->slice(0, -1)->implode($glue);
    }

    public function alias(): string
    {
        return $this->relation('_');
    }

    /**  @param  Builder<Model>  $builder */
    public function qualify(Builder $builder): string
    {
        $name = $this->name();
        $alias = $this->alias();

        return strlen($alias) > 0
            ? $alias.'.'.$name
            : $builder->qualifyColumn($name);
    }

    /** @return array<int, string> */
    public function segments(): array
    {
        /** @var array<int, string> $segments */
        $segments = $this->column()->explode('.')->toArray();

        return $segments;
    }
}
