<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Collections;

use Illuminate\Support\Collection;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @extends Collection<TKey, TValue>
 */
abstract class BaseCollection extends Collection
{
    //
}
