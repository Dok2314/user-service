<?php

declare(strict_types=1);

namespace App\Application\Identity\RegisterUser;

use App\Domain\Identity\Entities\User;
use App\Domain\Identity\Repositories\UserRepository;
use App\Domain\Identity\ValueObjects\Email;
use App\Domain\Identity\ValueObjects\UserId;
use DomainException;

final readonly class RegisterUserHandler
{
    public function __construct(private UserRepository $users) {}

    public function handle(RegisterUserCommand $command): UserId
    {
        $email = Email::fromString($command->email);

        if ($this->users->isEmailTaken($email)) {
            throw new DomainException('Email already taken');
        }

        $id = UserId::new();

        $user = User::register($id, $email, $command->name);

        $this->users->save($user);

        return $id;
    }
}
