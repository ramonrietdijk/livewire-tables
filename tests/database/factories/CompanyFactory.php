<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Company;

/** @extends Factory<Company> */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
        ];
    }
}
