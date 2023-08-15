<?php

namespace src\command\wallet\create;

use src\command\Command;
use src\command\CommandHandler;
use src\model\repository\WalletRepository;

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
