<?php

namespace src\routes;

use Slim\Factory\AppFactory;
use src\infra\controller\ControllerTest;
use src\infra\controller\middleware\MiddlewareExceptionResolveToHttpError;
use src\infra\controller\middleware\MiddlewareJsonBodyParser;
use src\infra\controller\middleware\MiddlewarePayloadValidator;
use src\infra\controller\UserCreateController;

require_once './src/config.php';

$app = AppFactory::createFromContainer($container);

$app->get('/', ControllerTest::class . ':execute');

$app->post('/user/create', UserCreateController::class . ':execute')->add(MiddlewarePayloadValidator::class)->add(new MiddlewareExceptionResolveToHttpError())->add(new MiddlewareJsonBodyParser());

$app->run();
