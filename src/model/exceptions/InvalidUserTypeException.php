<?php

namespace src\model\exceptions;

use RuntimeException;

final class InvalidUserTypeException extends RuntimeException 
{
    public function __construct(string $type)
    {
        parent::__construct();
        $this->message = sprintf("Could not create user with type: %s", $type);
    }
}
