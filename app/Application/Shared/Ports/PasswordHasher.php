<?php

declare(strict_types=1);

namespace App\Application\Shared\Ports;

interface PasswordHasher
{
    public function hash(string $plain): string;
}
