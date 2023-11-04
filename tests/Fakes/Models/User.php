<?php

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use RamonRietdijk\LivewireTables\Tests\Database\Factories\UserFactory;

/**
 * @property int $id
 * @property string $name
 * @property ?int $company_id
 * @property bool $is_admin
 * @property ?array $preferences
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property ?Carbon $deleted_at
 */
class User extends Model
{
    use HasFactory;

    protected $casts = [
        'is_admin' => 'boolean',
        'preferences' => 'array',
    ];

    /** @return Attribute<string, null> */
    public function uppercase(): Attribute
    {
        return Attribute::make(
            get: fn (): string => strtoupper($this->name),
        );
    }

    /** @return BelongsTo<Company, User> */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /** @return HasMany<Blog> */
    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'author_id');
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
