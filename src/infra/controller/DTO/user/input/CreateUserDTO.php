<?php

declare(strict_types=1);

namespace src\infra\controller\DTO\user\input;

final class CreateUserDTO
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $document,
        public readonly string $email,
        public readonly string $password,
        public readonly string $type
    ) {
    }
}
