<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Columns\Concerns;

use Closure;

/**
 * @property view-string $footerView
 */
trait HasFooter
{
    protected string $footerView = 'livewire-table::columns.footer.default';

    protected ?Closure $footerCallback = null;

    public function footer(?Closure $footerCallback = null): static
    {
        $this->footerCallback = $footerCallback;

        return $this;
    }

    public function getFooterContent(): mixed
    {
        if ($this->footerCallback === null) {
            return null;
        }

        return call_user_func($this->footerCallback);
    }

    public function hasFooter(): bool
    {
        return $this->footerCallback() !== null;
    }

    public function footerCallback(): ?Closure
    {
        return $this->footerCallback;
    }

    public function renderFooter(): mixed
    {
        return view($this->footerView, ['column' => $this]);
    }
}
