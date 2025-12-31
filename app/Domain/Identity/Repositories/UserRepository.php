<?php

declare(strict_types=1);

namespace App\Domain\Identity\Repositories;

use App\Domain\Identity\Entities\User;
use App\Domain\Identity\ValueObjects\Email;
use App\Domain\Identity\ValueObjects\UserId;

interface UserRepository
{
    public function getById(UserId $id): ?User;

    public function getByEmail(Email $email): ?User;

    public function save(User $user): void;

    public function isEmailTaken(Email $email, ?UserId $ignoreUserId = null): bool;
}
