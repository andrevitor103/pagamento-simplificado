<?php

namespace src\app\model;

use src\app\model\exceptions\InvalidUserTypeException;

final class UserFactory {
    public static function create(
        string $firstName,
        string $lastName,
        string $document,
        string $email,
        string $password,
        string $type,
        ?string $id = null
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
                $password,
                $id
            );
        }

        if ($type == UserType::COMMON->name) 
        {
            return CommonUser::create(
                $firstName,
                $lastName,
                $document,
                $email,
                $password,
                $id
            );
        }
        throw new InvalidUserTypeException($type);
    }
}