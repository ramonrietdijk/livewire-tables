<?php

declare(strict_types=1);

namespace RamonRietdijk\LivewireTables\Actions\Concerns;

trait HasConfirmation
{
    protected bool $confirmation = false;

    /** @var array<mixed> */
    protected array $confirmationData = [];

    public function confirmation(mixed ...$confirmationData): static
    {
        $this->confirmation = true;
        $this->confirmationData = $confirmationData;

        return $this;
    }

    public function withoutConfirmation(): static
    {
        $this->confirmation = false;
        $this->confirmationData = [];

        return $this;
    }

    public function hasConfirmation(): bool
    {
        return $this->confirmation;
    }

    /** @return array<mixed> */
    public function getConfirmationData(): array
    {
        return array_merge([
            'type' => $this->getVariant()->value,
            'title' => $this->label(),
            'body' => __('Are you sure you want to run this action?'),
            'cancel' => __('Cancel'),
            'run' => __('Run'),
        ], $this->confirmationData);
    }
}
