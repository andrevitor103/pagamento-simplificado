<?php

declare(strict_types=1);

namespace src\app\command\wallet\create;

use src\app\command\Command;

final class CreateCommand implements Command {
    public function __construct(
        public readonly string $userId
    ) {
    }
}
