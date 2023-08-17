<?php

namespace src\model\exceptions;

use RuntimeException;

final class AlreadyUserExistsException extends RuntimeException 
{
    public function __construct()
    {
        parent::__construct();
        $this->message = 'User already exists';
    }
}
