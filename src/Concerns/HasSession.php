<?php

namespace RamonRietdijk\LivewireTables\Concerns;

use Illuminate\Support\Str;

trait HasSession
{
    protected bool $useSession = false;

    /** @var array<int, string> */
    protected array $sessionProperties = [
        'columns',
        'columnOrder',
    ];

    public function updatedHasSession(string $property): void
    {
        if (! $this->useSession) {
            return;
        }

        $property = Str::of($property)->before('.')->toString();

        if (! in_array($property, $this->sessionProperties)) {
            return;
        }

        $this->updateSession();
    }

    protected function sessionKey(): string
    {
        return $this->identifier().':configuration';
    }

    protected function updateSession(): void
    {
        if (! $this->useSession) {
            return;
        }

        $data = [];

        foreach ($this->sessionProperties as $property) {
            if (property_exists($this, $property)) {
                $data[$property] = $this->{$property};
            }
        }

        session()->put($this->sessionKey(), $data);
    }

    protected function restoreSession(): void
    {
        if (! $this->useSession) {
            return;
        }

        $data = session()->get($this->sessionKey());

        if (is_array($data)) {
            $this->fill($data);
        }
    }
}
