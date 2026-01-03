<?php

declare(strict_types=1);

namespace App\Domain\Identity\ValueObjects;

use InvalidArgumentException;
use Illuminate\Support\Str;

readonly final class UserId
{
    public string $value;

    public function __construct(string $value)
    {
        $value = trim($value);

        if ($value === '') {
            throw new InvalidArgumentException('UserId cannot be empty');
        }

        $this->value = $value;
    }

    public static function new(): self
    {
        return new self((string) Str::uuid());
    }

    public static function fromString(string $id): self
    {
        return new self($id);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
