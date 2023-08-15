<?php

namespace src\model;

final class Wallet {
    public function __construct(
        public readonly string $userId,
        public readonly float $balance
    ) {   
    }
}
