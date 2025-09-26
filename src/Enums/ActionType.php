<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Enums;

enum ActionType: string
{
    case Bulk = 'bulk';
    case Standalone = 'standalone';
    case Record = 'record';
}
