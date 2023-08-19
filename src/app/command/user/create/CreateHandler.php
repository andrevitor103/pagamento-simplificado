<?php

namespace src\app\command\user\create;

use src\app\command\Command;
use src\app\command\CommandHandler;
use src\app\command\wallet\create\CreateCommand as WalletCommand;
use src\app\command\wallet\create\CreateHandler as WalletCreate;
use src\app\model\exceptions\AlreadyUserExistsException;
use src\app\model\repository\UserRepository;
use src\app\model\UserFactory;

final class CreateHandler implements CommandHandler {
    public function __construct(
        private readonly UserRepository $repository,
        private readonly WalletCreate $createWallet
        ) {
        }

    public function execute(Command|CreateCommand $command): void
    {
        $user = $this->repository->findByParams($command->email, $command->document);

        if ($user) 
        {
            throw new AlreadyUserExistsException();
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
