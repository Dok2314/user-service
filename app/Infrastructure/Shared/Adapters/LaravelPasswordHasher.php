<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Adapters;

use App\Application\Shared\Ports\PasswordHasher;
use App\Domain\Identity\ValueObjects\PasswordHash;
use Illuminate\Support\Facades\Hash;

final class LaravelPasswordHasher implements PasswordHasher
{
    public function hash(string $plain): PasswordHash
    {
        return new PasswordHash(Hash::make($plain));
    }

    public function verify(string $plain, PasswordHash $hash): bool
    {
        return Hash::check($plain, $hash->value());
    }
}

