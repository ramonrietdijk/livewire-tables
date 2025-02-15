<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Enums;

enum SearchScope: string
{
    case Global = 'global';
    case Column = 'column';
}
