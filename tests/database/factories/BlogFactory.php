<?php

namespace RamonRietdijk\LivewireTables\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Blog;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Category;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;

/** @extends Factory<Blog> */
class BlogFactory extends Factory
{
    protected $model = Blog::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'title' => fake()->text(100),
            'body' => fake()->paragraph(),
            'author_id' => User::factory(),
            'category_id' => Category::factory(),
            'published' => fake()->boolean(),
        ];
    }

    public function published(bool $published = true): static
    {
        return $this->state(fn (array $attributes) => [
            'published' => $published,
        ]);
    }

    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted_at' => fake()->dateTime(),
        ]);
    }
}
