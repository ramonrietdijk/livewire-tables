<?php

namespace RamonRietdijk\LivewireTables\Tests\Unit\Columns\Concerns;

use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\Company;
use RamonRietdijk\LivewireTables\Tests\Fakes\Models\User;
use RamonRietdijk\LivewireTables\Tests\TestCase;

class HasValueTest extends TestCase
{
    /** @test */
    public function it_can_have_a_display_callback(): void
    {
        $column = Column::make('Column', 'column');

        $this->assertNull($column->displayUsingCallback());

        $column->displayUsing(fn () => '');

        $this->assertNotNull($column->displayUsingCallback());
    }

    /** @test */
    public function it_can_get_values(): void
    {
        /** @var Company $company */
        $company = Company::factory()->create(['name' => 'Company']);

        /** @var User $user */
        $user = User::factory()->create(['company_id' => $company->id]);

        $column = Column::make('Company', 'company.name');

        $value = $column->getValue($user);

        $this->assertEquals('Company', $value);
    }

    /** @test */
    public function it_can_get_values_without_a_column(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $column = Column::make('Column');

        $value = $column->getValue($user);

        $this->assertEquals($user, $value);
    }

    /** @test */
    public function it_can_resolve_values(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['name' => 'John Doe']);

        $column = Column::make('Name', 'name');

        $value = $column->resolveValue($user);

        $this->assertEquals('John Doe', $value);
    }

    /** @test */
    public function it_can_resolve_values_with_a_callback(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['name' => 'John Doe']);

        $column = Column::make('Name', 'name')
            ->displayUsing(fn (string $name): string => strtoupper($name));

        $value = $column->resolveValue($user);

        $this->assertEquals('JOHN DOE', $value);
    }
}
