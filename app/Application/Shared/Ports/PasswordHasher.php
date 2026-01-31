<?php

declare(strict_types=1);

namespace App\Application\Shared\Ports;

use App\Domain\Identity\ValueObjects\PasswordHash;

interface PasswordHasher
{
    public function hash(string $plain): PasswordHash;

    public function verify(string $plain, PasswordHash $hash): bool;
}
