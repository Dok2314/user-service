<?php

declare(strict_types=1);

namespace App\Application\Identity\Command\RegisterUser;

use App\Application\Shared\Ports\{
    IdGenerator,
    PasswordHasher,
    TransactionManager
};

use App\Domain\Identity\ValueObjects\{
    Email,
    PasswordHash,
    UserId
};

use App\Domain\Identity\Entities\User;
use App\Domain\Identity\Repositories\UserRepository;
use DomainException;

final readonly class RegisterUserHandler
{
    public function __construct(
        private IdGenerator        $idGenerator,
        private PasswordHasher     $passwordHasher,
        private TransactionManager $tx,
        private UserRepository     $users,
    ) {}

    public function handle(RegisterUserCommand $command): UserId
    {
        return $this->tx->run(function () use ($command): UserId {
            $email = Email::fromString($command->email);

            if ($this->users->isEmailTaken($email)) {
                throw new DomainException('Email already taken');
            }

            $userId = UserId::fromString($this->idGenerator->next());

            $passwordHash = new PasswordHash(
                $this->passwordHasher->hash($command->password)
            );

            $user = User::register(
                $userId,
                $passwordHash,
                $email,
                $command->name
            );

            $this->users->save($user);

            return $userId;
        });
    }
}
