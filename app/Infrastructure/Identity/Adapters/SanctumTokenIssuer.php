<?php

namespace App\Infrastructure\Identity\Adapters;

use App\Application\Shared\Ports\TokenIssuer;
use App\Domain\Identity\ValueObjects\UserId;
use App\Infrastructure\Identity\Persistence\Models\User;

final class SanctumTokenIssuer implements TokenIssuer
{
    public function issue(UserId $userId, string $tokenName = 'api'): string
    {
        $user = User::query()->findOrFail((string) $userId);

        return $user
            ->createToken($tokenName)
            ->plainTextToken;
    }
}
