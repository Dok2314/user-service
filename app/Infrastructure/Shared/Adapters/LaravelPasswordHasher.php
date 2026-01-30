<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Adapters;

use App\Application\Shared\Ports\PasswordHasher;
use Illuminate\Support\Facades\Hash;

final class LaravelPasswordHasher implements PasswordHasher
{
    public function hash(string $plain): string
    {
        return Hash::make($plain);
    }
}
