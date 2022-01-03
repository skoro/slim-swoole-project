<?php

namespace App\Entities;

use JsonSerializable;

class User implements JsonSerializable
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private bool $active
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return array<string, string|int|bool>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'active' => $this->active,
        ];
    }
}
