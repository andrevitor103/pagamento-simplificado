<?php

namespace src\app\model\exceptions;

use DomainException;

final class AlreadyUserExistsException extends DomainException
{
    public function __construct()
    {
        parent::__construct();
        $this->message = 'User already exists';
    }
}
