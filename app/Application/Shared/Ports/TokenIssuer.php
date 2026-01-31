<?php

declare(strict_types=1);

namespace App\Application\Shared\Ports;

use App\Domain\Identity\ValueObjects\UserId;

interface TokenIssuer
{
    public function issue(UserId $userId, string $tokenName = 'api'): string;
}
