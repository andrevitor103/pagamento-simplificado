<?php

declare(strict_types=1);

namespace src\infra\http\controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use src\app\command\user\create\CreateCommand;
use src\app\command\user\create\CreateHandler;

final class UserCreateController 
{
    public function __construct(
        private readonly CreateHandler $handler
    ) {
    }
    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = $request->getParsedBody();
        $this->handler->execute(
            new CreateCommand(
                $data['firstName'],
                $data['lastName'],
                $data['document'],
                $data['email'],
                $data['password'],
                $data['type']
            )
        );
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
    }
}
