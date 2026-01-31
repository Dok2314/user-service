<?php

declare(strict_types=1);

namespace App\Application\Identity\Command\LoginUser;

use App\Application\Shared\Ports\{
    PasswordHasher,
    TokenIssuer
};

use App\Domain\Identity\Repositories\UserRepository;
use App\Domain\Identity\ValueObjects\Email;
use DomainException;

final readonly class LoginUserHandler
{
    public function __construct(
        private UserRepository $users,
        private PasswordHasher $passwordHasher,
        private TokenIssuer $tokenIssuer,
    ) {}

    public function handle(LoginUserCommand $command): string
    {
        $email = Email::fromString($command->email);

        $user = $this->users->getByEmail($email);

        if ($user === null) {
            throw new DomainException('Invalid credentials');
        }

        if (!$this->passwordHasher->verify(
            $command->password,
            $user->passwordHash()
        )) {
            throw new DomainException('Invalid credentials');
        }

        return $this->tokenIssuer->issue($user->id());
    }
}
