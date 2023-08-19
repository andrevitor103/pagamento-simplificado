<?php

namespace src\app\model\repository;

use src\app\model\Wallet;

interface WalletRepository {
    public function create(string $userId): void;
    public function find(string $userId): Wallet|null;
    public function push(Wallet $wallet): void;
}
