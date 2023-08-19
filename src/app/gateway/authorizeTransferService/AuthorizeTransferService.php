<?php

declare(strict_types=1);

namespace src\app\gateway\authorizeTransferService;
interface AuthorizeTransferService
{
    public function permittedOperation(): bool;
}
