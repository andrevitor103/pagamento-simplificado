<?php

use DI\Container;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Factory;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use src\app\gateway\authorizeTransferService\AuthorizeTransferService as AuthorizeTransferServiceInterface;
use src\app\model\repository\UserRepository;
use src\app\model\repository\WalletRepository;
use src\infra\http\controller\validation\FactoryServiceProvider;
use src\infra\http\gateway\AuthorizeTransferService;
use src\infra\repository\UserRepositoryInMemory;
use src\infra\repository\WalletRepositoryInMemory;

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

$container->set(Factory::class, function () {
    return FactoryServiceProvider::buildDefault();
});

$container->set(AuthorizeTransferServiceInterface::class, function () {
    return new AuthorizeTransferService(new Client());
});

$container->set(LoggerInterface::class, function () {
    $logger = new Logger('');
    $logger->pushHandler(new StreamHandler(__DIR__.'/pagamento_simplificado_logs.log'));
    $logger->pushHandler(new ErrorLogHandler());
    return $logger;
});

return $container;
