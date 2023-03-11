<?php

namespace RamonRietdijk\LivewireTables\Enums;

enum TrashedMode: string
{
    case WithoutTrashed = 'withoutTrashed';
    case WithTrashed = 'withTrashed';
    case OnlyTrashed = 'onlyTrashed';
}
