<?php

namespace src\model;

use Ramsey\Uuid\Nonstandard\Uuid;

final class ShopkeeperUser implements User {

    public function __construct(
        private readonly string $id,
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $document,
        private readonly string $email,
        private readonly string $password
    ) {
    }

    public static function create(
        string $firstName,
        string $lastName,
        string $document,
        string $email,
        string $password
    ): self
    {
        $id = Uuid::uuid4()->toString();
        return new self(
            $id,
            $firstName,
            $lastName,
            $document,
            $email,
            $password
        );
    }

    public function getId(): string 
    {
        return $this->id;
    }

    public function getFirtName(): string 
    {
        return $this->firstName;
    }

    public function getLastName(): string 
    {
        return $this->lastName;
    }

    public function getDocument(): string 
    {
        return $this->document;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword(): string 
    {
        return $this->password;
    }

    public function getType(): UserType {
        return UserType::SHOPKEEPER;
    }

}
