<?php

use DI\Container;
use src\infra\repository\UserRepositoryInMemory;
use src\infra\repository\WalletRepositoryInMemory;
use src\model\repository\UserRepository;
use src\model\repository\WalletRepository;

$configuration = [
    'settings' => [
        'displayErrorDetails' => getenv('DISPLAY_ERRORS_DETAILS'),
    ],
];
$container = new Container($configuration);

$container->set(UserRepository::class, function () {
    return new UserRepositoryInMemory();
});

$container->set(WalletRepository::class, function () {
    return new WalletRepositoryInMemory();
});

return $container;