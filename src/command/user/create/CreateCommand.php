<?php

namespace src\user\command;

use src\command\Command;

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
