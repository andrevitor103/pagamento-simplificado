<?php

namespace src\routes;

use Slim\Factory\AppFactory;
use src\controller\ControllerTest;
use src\controller\middleware\HttpErrorsResolveMiddleware;
use src\controller\middleware\JsonBodyParserMiddleware;
use src\controller\UserCreateController;
use src\controller\validation\UserCreateRequestValidation;

require_once './src/config.php';

$app = AppFactory::createFromContainer($container);

$app->get('/', ControllerTest::class . ':execute');

$app->post('/user/create', UserCreateController::class . ':execute')->add(new UserCreateRequestValidation())->add(new HttpErrorsResolveMiddleware())->add(new JsonBodyParserMiddleware());

$app->run();
