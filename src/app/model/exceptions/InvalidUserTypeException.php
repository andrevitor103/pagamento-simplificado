<?php

namespace src\app\model\exceptions;

use DomainException;

final class InvalidUserTypeException extends DomainException
{
    public function __construct(string $type)
    {
        parent::__construct();
        $this->message = sprintf("Could not create user with type: %s", $type);
    }
}
