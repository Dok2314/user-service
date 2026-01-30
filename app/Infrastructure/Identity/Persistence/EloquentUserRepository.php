<?php

declare(strict_types=1);

namespace App\Infrastructure\Identity\Persistence;

use App\Domain\Identity\Entities\User as DomainUser;
use App\Domain\Identity\Repositories\UserRepository;
use App\Domain\Identity\ValueObjects\Email;
use App\Domain\Identity\ValueObjects\PasswordHash;
use App\Domain\Identity\ValueObjects\UserId;
use App\Infrastructure\Identity\Persistence\Models\User as EloquentUser;

final class EloquentUserRepository implements UserRepository
{
    public function getById(UserId $id): ?DomainUser
    {
        $model = EloquentUser::query()->find((string) $id);
        return $model ? $this->toDomain($model) : null;
    }

    public function getByEmail(Email $email): ?DomainUser
    {
        $model = EloquentUser::query()
            ->where('email', (string) $email)
            ->first();
        return $model ? $this->toDomain($model) : null;
    }

    public function save(DomainUser $user): void
    {
        EloquentUser::query()->updateOrCreate(
            ['id' => (string) $user->id()],
            [
                'email' => (string) $user->email(),
                'name'  => $user->name(),
                'password' => $user->passwordHash()
            ],
        );
    }

    public function isEmailTaken(Email $email, ?UserId $ignoreUserId = null): bool
    {
        $q = EloquentUser::query()->where('email', (string) $email);

        if ($ignoreUserId !== null) {
            $q->where('id', '!=', (string) $ignoreUserId);
        }

        return $q->exists();
    }

    private function toDomain(EloquentUser $model): DomainUser
    {
        return new DomainUser(
            id: UserId::fromString((string) $model->id),
            email: Email::fromString((string) $model->email),
            name: (string) $model->name,
            passwordHash: new PasswordHash((string) $model->password),
        );
    }
}
