<?php

declare(strict_types=1);

namespace src\command\user\create;

use src\command\Command;
use src\infra\controller\DTO\user\input\CreateUserDTO;

final class CreateCommand implements Command {
    public function __construct(
        public readonly CreateUserDTO $user
    ) {
    }
}
