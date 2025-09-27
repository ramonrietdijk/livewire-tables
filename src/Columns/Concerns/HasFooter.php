<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

use Closure;

trait HasFooter
{
    /** @phpstan-var view-string */
    protected string $footerView = 'livewire-table::columns.footer.default';

    protected ?Closure $footerCallback = null;

    public function footer(?Closure $footerCallback = null): static
    {
        $this->footerCallback = $footerCallback;

        return $this;
    }

    public function footerCallback(): ?Closure
    {
        return $this->footerCallback;
    }

    public function getFooterContent(): mixed
    {
        if (($callback = $this->footerCallback()) !== null) {
            return call_user_func($callback);
        }

        return null;
    }

    public function hasFooter(): bool
    {
        return $this->footerCallback() !== null;
    }

    public function renderFooter(): mixed
    {
        return view($this->footerView, ['column' => $this]);
    }
}
