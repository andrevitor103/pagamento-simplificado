<?php

namespace src\command\user\create;

use src\command\Command;
use src\command\CommandHandler;
use src\command\wallet\create\CreateHandler as WalletCreate;
use src\command\wallet\create\CreateCommand as WalletCommand;
use src\model\exceptions\AlreadyUserExistsException;
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
        $user = $this->repository->find($command->user->email, $command->user->document);

        if ($user) 
        {
            throw new AlreadyUserExistsException();
        }

        $user = UserFactory::create(
            $command->user->firstName,
            $command->user->lastName,
            $command->user->document,
            $command->user->email,
            $command->user->password,
            $command->user->type
        );

        $this->repository->create($user);
        $this->createWallet->execute(new WalletCommand($user->getId()));
    }
}
