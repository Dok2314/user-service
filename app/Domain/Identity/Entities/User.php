<?php

declare(strict_types=1);

namespace App\Domain\Identity\Entities;

use App\Domain\Identity\ValueObjects\Email;
use App\Domain\Identity\ValueObjects\PasswordHash;
use App\Domain\Identity\ValueObjects\UserId;
use InvalidArgumentException;

final class User
{
    public function __construct(
        public readonly UserId        $id,
        private readonly PasswordHash $passwordHash,
        private Email                 $email,
        private string                $name,
    )
    {
        $this->setName($name);
    }

    public static function register(
        UserId       $id,
        PasswordHash $passwordHash,
        Email        $email,
        string       $name,
    ): self
    {
        return new self($id, $passwordHash, $email, $name);
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function passwordHash(): PasswordHash
    {
        return $this->passwordHash;
    }

    public function changeEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function changeName(string $name): void
    {
        $this->setName($name);
    }

    private function setName(string $name): void
    {
        $name = trim($name);

        if ($name === '') {
            throw new InvalidArgumentException('Name cannot be empty');
        }

        $this->name = $name;
    }
}
