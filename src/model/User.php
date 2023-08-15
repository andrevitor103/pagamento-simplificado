<?php

namespace src\model;

interface User {
    public function getId(): string;
    public function getFirtName(): string;
    public function getLastName(): string;
    public function getDocument(): string;
    public function getEmail(): string;
    public function getPassword(): string;
    public function getType(): UserType;
    public static function create( string $firstName, string $lastName, string $document, string $email, string $password): User;
}
