<?php

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use RamonRietdijk\LivewireTables\Tests\Database\Factories\CategoryFactory;

/**
 * @property int $id
 * @property string $title
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class Category extends Model
{
    use HasFactory;

    /** @return HasMany<Blog> */
    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }
}
