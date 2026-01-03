<?php

declare(strict_types=1);

namespace App\Application\Identity\Command\RegisterUser;

final readonly class RegisterUserCommand
{
    public function __construct(
        public string $email,
        public string $name,
        public string $password,
    ) {}
}
