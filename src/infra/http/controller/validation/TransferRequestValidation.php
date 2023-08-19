<?php

declare(strict_types=1);

namespace src\infra\http\controller\validation;

final class TransferRequestValidation implements Validation
{
    public function getRules(): array
    {
        return [
            'originAccountId' => 'required',
            'destinationAccountId' => 'required',
            'amount' => 'required',
        ];
    }
}
