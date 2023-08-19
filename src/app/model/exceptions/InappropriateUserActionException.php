<?php

declare(strict_types=1);

namespace src\app\model\exceptions;

use DomainException;

final class InappropriateUserActionException extends DomainException
{
    public function __construct()
    {
        parent::__construct();
        $this->message = 'Operation not allowed';
    }
}
