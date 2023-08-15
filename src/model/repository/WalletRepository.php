<?php

namespace src\model\repository;

interface WalletRepository {
    public function create(string $userId): void;
}
