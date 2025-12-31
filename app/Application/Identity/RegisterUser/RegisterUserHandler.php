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

    // Этап 4.2: handle() выполняет команду и возвращает результат (пока вернём UserId)
    public function handle(RegisterUserCommand $command): UserId
    {
        // Этап 4.3: превращаем строку в ValueObject Email (там же валидация)
        $email = Email::fromString($command->email);

        // Этап 4.4: проверяем бизнес-правило "email уникален" через репозиторий
        if ($this->users->isEmailTaken($email)) {
            throw new DomainException('Email already taken');
        }

        // Этап 4.5: генерируем новый идентификатор пользователя
        $id = UserId::new();

        // Этап 4.6: создаём пользователя через домен (named constructor register)
        $user = User::register($id, $email, $command->name);

        // Этап 4.7: сохраняем пользователя (как именно — решит Infrastructure)
        $this->users->save($user);

        // Этап 4.8: возвращаем id созданного пользователя
        return $id;
    }
}
