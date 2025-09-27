<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Enums;

enum ActionKind: string
{
    case Callback = 'callback';
    case Script = 'script';
}
