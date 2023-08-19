<?php

namespace src\app\model;

final class Wallet
{
    public function __construct(
        private readonly string $userId,
        private float $balance
    ) {   
    }
    public function credit(float $amount): void
    {
        $this->balance += $amount;
    }
    public function debit(float $amount): void
    {
        $this->balance -= $amount;
    }
    public function hasBalanceToDebit(float $amount): bool
    {
        return $this->balance >= $amount;
    }
}
