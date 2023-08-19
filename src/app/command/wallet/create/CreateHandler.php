<?php

declare(strict_types=1);

namespace src\app\command\wallet\create;

use src\app\command\Command;
use src\app\command\CommandHandler;
use src\app\model\repository\WalletRepository;

final class CreateHandler implements CommandHandler {
    public function __construct(
        private readonly WalletRepository $repository
    ) {
    }
    public function execute(Command|CreateCommand $command): void
    {
        $this->repository->create($command->userId);
    }
}
