<?php

namespace src\routes;

use Slim\Factory\AppFactory;
use src\infra\http\controller\ControllerTest;
use src\infra\http\controller\middleware\MiddlewareExceptionResolveToHttpError;
use src\infra\http\controller\middleware\MiddlewareJsonBodyParser;
use src\infra\http\controller\middleware\MiddlewarePayloadValidator;
use src\infra\http\controller\TransferController;
use src\infra\http\controller\UserCreateController;

require_once './src/config.php';

$app = AppFactory::createFromContainer($container);

$app->get('/', ControllerTest::class . ':execute');

$app->post('/user/create', UserCreateController::class . ':execute')->add(MiddlewarePayloadValidator::class)->add(new MiddlewareExceptionResolveToHttpError())->add(new MiddlewareJsonBodyParser());

$app->post('/transfer', TransferController::class . ':execute')->add(MiddlewarePayloadValidator::class)->add(new MiddlewareExceptionResolveToHttpError())->add(new MiddlewareJsonBodyParser());

$app->run();
