<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Category;

/** @extends Factory<Category> */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
        ];
    }
}
