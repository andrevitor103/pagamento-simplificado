<?php

namespace src\controller\validation;

use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;

final class UserCreateRequestValidation implements MiddlewareInterface
{
    public function process(Request $request, Handler $handler): Response
    {
        return $handler->handle($request);
    }
}