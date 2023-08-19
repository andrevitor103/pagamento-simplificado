<?php

declare(strict_types=1);

namespace src\app\command\transfer;

use src\app\command\Command;

final class TransferCommand implements Command
{
    public function __construct(
        public readonly string $originAccountId,
        public readonly string $destinationAccountId,
        public readonly float  $amount
    ) {
    }
}
