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
        $type = strtoupper($type);
        if ($type == UserType::SHOPKEEPER->name) 
        {
            return ShopkeeperUser::create(
                $firstName,
                $lastName,
                $document,
                $email,
                $password
            );
        }

        if ($type == UserType::COMMON->name) 
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