<?php

declare(strict_types=1);

namespace src\infra\http\controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use src\app\command\transfer\TransferCommand;
use src\app\command\transfer\TransferHandler;

final class TransferController
{
    public function __construct(
        private readonly TransferHandler $handler
    ) {
    }
    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = $request->getParsedBody();
        $this->handler->execute(new TransferCommand(
            $data['originAccountId'],
            $data['destinationAccountId'],
            $data['amount']
            ));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(204);
    }
}
