<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Tag;

/** @extends Factory<Tag> */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
        ];
    }
}
