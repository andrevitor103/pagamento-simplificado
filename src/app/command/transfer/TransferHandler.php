<?php

declare(strict_types=1);

namespace src\app\command\transfer;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use RuntimeException;
use Slim\Logger;
use src\app\command\Command;
use src\app\command\CommandHandler;
use src\app\gateway\authorizeTransferService\AuthorizeTransferService;
use src\app\model\repository\UserRepository;
use src\app\model\repository\WalletRepository;
use src\app\model\Transfer;

final class TransferHandler implements CommandHandler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly WalletRepository $walletRepository,
        private readonly AuthorizeTransferService $authorizeTransferService
    ) {
    }
    public function execute(TransferCommand|Command $command): void
    {
        $amount = $command->amount;
        $originAccount = $this->userRepository->find($command->originAccountId);
        $destinationAccount = $this->userRepository->find($command->destinationAccountId);

        $transfer = Transfer::create($originAccount, $destinationAccount, $amount);

        $originWallet = $this->walletRepository->find($transfer->originAccount->getId());
        $destinationWallet = $this->walletRepository->find($transfer->destinationAccount->getId());

        if (!$originWallet->hasBalanceToDebit($amount))
        {
            throw new RuntimeException('Insufficient funds');
        }
        if (!$this->authorizeTransferService->permittedOperation())
        {
            throw new RuntimeException('Unauthorized operation');
        }
        $originWallet->debit($amount);
        $destinationWallet->credit($amount);
        $this->walletRepository->push($originWallet);
        $this->walletRepository->push($destinationWallet);
    }
}
