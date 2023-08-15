<?php

namespace src\model;

final class Transfer {
    public function __construct(
        public readonly string $originAccount,
        public readonly string $destinationAccount,
        public readonly float $amount
    ) {   
    }
}
