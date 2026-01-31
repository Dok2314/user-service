<?php

declare(strict_types=1);

namespace App\Application\Identity\Command\LoginUser;

use App\Application\Shared\Bus\Command\Command;

final readonly class LoginUserCommand implements Command
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}
