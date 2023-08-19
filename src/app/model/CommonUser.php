<?php

namespace src\app\model;

use Ramsey\Uuid\Uuid;


final class CommonUser implements User {

    private function __construct(
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
        string $password,
        ?string $id
    ): self
    {
        if (!$id) {
            $id = Uuid::uuid4()->toString();
        }
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
        return UserType::COMMON;
    }

}
