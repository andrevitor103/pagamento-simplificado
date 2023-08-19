<?php

declare(strict_types=1);

namespace src\infra\cli;

use Psr\Log\LoggerInterface;
use src\app\command\transfer\TransferCommand;
use src\app\command\transfer\TransferHandler;

final class TransferControllerCli
{
    public function __construct(
        private readonly TransferHandler $handler,
        private readonly LoggerInterface $logger
    ) {
    }
    public function execute(string $originAccountId, string $destinationAccountId, string $amount): void
    {
        try {
            $this->handler->execute(new TransferCommand(
                $originAccountId,
                $destinationAccountId,
                (float) $amount
            ));
        } catch (\Throwable $th) {
            $this->logger->error('server_error',[
                'data' => $th->getMessage(),
                'previous' => $th->getPrevious()
            ]);
        }
    }
}
