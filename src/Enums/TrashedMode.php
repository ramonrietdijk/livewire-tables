<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Enums;

enum TrashedMode: string
{
    case WithoutTrashed = 'withoutTrashed';
    case WithTrashed = 'withTrashed';
    case OnlyTrashed = 'onlyTrashed';
}
