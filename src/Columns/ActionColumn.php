<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Columns;

use Override;

class ActionColumn extends BaseColumn
{
    protected string $view = 'livewire-table::columns.content.action';

    #[Override]
    protected function configure(): void
    {
        parent::configure();

        $this
            ->header(false)
            ->computed()
            ->clickable(false);
    }
}
