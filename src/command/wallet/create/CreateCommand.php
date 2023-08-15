<?php

namespace src\command\wallet\create;

use src\command\Command;

final class CreateCommand implements Command {
    public function __construct(
        public readonly string $userId
    ) {
    }
}