<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Columns;

use Override;
use RamonRietdijk\LivewireTables\Columns\Concerns\HasSize;

class ImageColumn extends BaseColumn
{
    use HasSize;

    protected string $view = 'livewire-table::columns.content.image';

    #[Override]
    protected function configure(): void
    {
        parent::configure();

        $this->header(false);
    }
}
