<?php

declare(strict_types=1);

namespace src\app\model;

use src\app\model\exceptions\InappropriateUserActionException;

final class Transfer
{
    private function __construct(
        public readonly User $originAccount,
        public readonly User $destinationAccount,
        public readonly float $amount
    ) {   
    }
    public static function create(
        User $originAccount,
        User $destinationAccount,
        float $amount
    ): Transfer
    {
        if ($originAccount instanceof ShopkeeperUser)
        {
            throw new InappropriateUserActionException();
        }
        return new Transfer($originAccount, $destinationAccount, $amount);
    }
}
