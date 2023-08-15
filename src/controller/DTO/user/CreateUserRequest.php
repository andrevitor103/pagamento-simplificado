<?php

namespace src\controller\DTO\user;

final class CreateUserRequest 
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $document,
        public readonly string $email,
        public readonly string $password,
        public readonly string $type
    ) {
    }

    public static function create(array $data): self
    {
        return new Self(
            $data['firstName'],
            $data['lastName'],
            $data['document'],
            $data['email'],
            $data['password'],
            $data['type']
        );
    }
}
