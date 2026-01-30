<?php

declare(strict_types=1);

namespace App\Domain\Identity\ValueObjects;

use InvalidArgumentException;

readonly final class UserId
{
    public function __construct(public string $value)
    {
        $value = trim($value);

        if ($value === '') {
            throw new InvalidArgumentException('UserId cannot be empty');
        }
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
