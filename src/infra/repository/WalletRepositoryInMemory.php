<?php

namespace src\infra\repository;

use src\app\model\repository\WalletRepository;
use src\app\model\Wallet;

final class WalletRepositoryInMemory implements WalletRepository 
{
    public function create(string $userId): void {

    }
    public function find(string $userId): ?Wallet
    {
        return $this->getWallet($userId) ?? null;
    }

    public function push(Wallet $wallet): void
    {
        // TODO: Implement push() method.
    }

    private function getWallet(string $userID): ?Wallet
    {
        $wallet = [
            'cc8b43ca-207f-4b73-be25-9b8c194ee5f8' => new Wallet('cc8b43ca-207f-4b73-be25-9b8c194ee5f8', 10),
            'ea2bcb8d-fd48-483f-8a15-763d40a0c360' => new Wallet('ea2bcb8d-fd48-483f-8a15-763d40a0c360', 20)
        ];
        return $wallet[$userID] ?? null;
    }
}
