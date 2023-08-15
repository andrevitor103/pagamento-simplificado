<?php

namespace src\model;

use RuntimeException;

final class UserFactory {
    public static function create(
        string $firstName,
        string $lastName,
        string $document,
        string $email,
        string $password,
        string $type
    ): User
    {
        if (strtoupper($type) == UserType::SHOPKEEPER) 
        {
            return ShopkeeperUser::create(
                $firstName,
                $lastName,
                $document,
                $email,
                $password
            );
        }

        if (strtoupper($type) == UserType::COMMON) 
        {
            return CommonUser::create(
                $firstName,
                $lastName,
                $document,
                $email,
                $password
            );
        }
        throw new RuntimeException("Could not create user with type: $type");
    }
}