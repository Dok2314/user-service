<?php

declare(strict_types=1);

namespace App\Domain\Identity\ValueObjects;

use InvalidArgumentException;

readonly final class Email
{
    private string $value;

    public function __construct(string $value)
    {
        $value = mb_strtolower(trim($value));

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email');
        }

        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
