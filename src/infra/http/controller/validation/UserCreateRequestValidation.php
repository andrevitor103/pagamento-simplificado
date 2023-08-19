<?php

namespace src\infra\http\controller\validation;

final class UserCreateRequestValidation implements Validation
{
    public function getRules(): array
    {
        return [
            'firstName' => 'required',
            'lastName'  => 'required',
            'document'  => 'required',
            'email'     => 'required',
            'password'  => 'required',
            'type'      => 'required'
        ];
    }
}
