<?php

namespace src\command\user\create;

use RuntimeException;
use src\command\Command;
use src\command\CommandHandler;
use src\command\wallet\create\CreateHandler as WalletCreate;
use src\command\wallet\create\CreateCommand as WalletCommand;
use src\model\repository\UserRepository;
use src\model\UserFactory;

final class CreateHandler implements CommandHandler {
    public function __construct(
        private readonly UserRepository $repository,
        private readonly WalletCreate $createWallet
        ) {
        }

    public function execute(Command|CreateCommand $command): void
    {
        $user = $this->repository->find($command->email, $command->document);

        if ($user) 
        {
            throw new RuntimeException('User already exists');
        }

        $user = UserFactory::create(
            $command->firstName,
            $command->lastName,
            $command->document,
            $command->email,
            $command->password,
            $command->type
        );

        $this->repository->create($user);
        $this->createWallet->execute(new WalletCommand($user->getId()));
    }
}
