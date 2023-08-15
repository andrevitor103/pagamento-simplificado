<?php

namespace src\controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use src\command\user\create\CreateCommand;
use src\command\user\create\CreateHandler as CreateCreateHandler;
use src\controller\DTO\user\CreateUserRequest;

final class UserCreateController 
{
    public function __construct(
        private readonly CreateCreateHandler $handler
    ) {
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response)
    {
        $data = CreateUserRequest::create($request->getParsedBody());
        $this->handler->execute(
            new CreateCommand(
                $data->firstName,
                $data->lastName,
                $data->document,
                $data->email,
                $data->password,
                $data->type,
            )
        );
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
    }
}
