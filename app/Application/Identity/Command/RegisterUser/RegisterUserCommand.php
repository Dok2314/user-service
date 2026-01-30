<?php

declare(strict_types=1);

namespace App\Application\Identity\Command\RegisterUser;

use App\Application\Shared\Bus\Command\Command;

final readonly class RegisterUserCommand implements Command
{
    public function __construct(
        public string $email,
        public string $name,
        public string $password,
    ) {}
}
