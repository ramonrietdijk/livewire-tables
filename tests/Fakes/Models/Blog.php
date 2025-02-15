<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Fakes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use RamonRietdijk\LivewireTables\Tests\Database\Factories\BlogFactory;

/**
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $thumbnail
 * @property int $author_id
 * @property ?int $category_id
 * @property bool $published
 * @property int $order
 * @property ?array<string, mixed> $settings
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property ?Carbon $deleted_at
 */
class Blog extends Model
{
    /** @use HasFactory<BlogFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $casts = [
        'published' => 'boolean',
        'settings' => 'array',
    ];

    /** @return BelongsTo<User, $this> */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return BelongsTo<Category, $this> */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /** @return BelongsToMany<Tag, $this> */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    protected static function newFactory(): BlogFactory
    {
        return BlogFactory::new();
    }
}
