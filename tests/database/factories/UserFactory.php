<?php

namespace RamonRietdijk\LivewireTables\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Company;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;

/** @extends Factory<User> */
class UserFactory extends Factory
{
    protected $model = User::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'company_id' => Company::factory(),
            'is_admin' => false,
        ];
    }

    public function admin(bool $admin = true): static
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => $admin,
        ]);
    }

    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted_at' => fake()->dateTime(),
        ]);
    }
}
