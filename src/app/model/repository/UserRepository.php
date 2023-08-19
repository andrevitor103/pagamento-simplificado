<?php

namespace src\app\model\repository;

use src\app\model\User;

interface UserRepository {
    public function create(User $user): void;
    public function findByParams(?string $email = null, ?string $document = null): User|null;
    public function find(string $id): User|null;
}
