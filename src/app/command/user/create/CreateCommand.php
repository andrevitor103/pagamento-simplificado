<?php

declare(strict_types=1);

namespace src\app\command\user\create;

use src\app\command\Command;
use src\infra\controller\DTO\user\input\CreateUserDTO;

final class CreateCommand implements Command {
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
