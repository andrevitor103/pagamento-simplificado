<?php

namespace src\model\repository;

use src\model\User;

interface UserRepository {
    public function create(User $user): void;
    public function find(?string $email = null, ?string $document = null): User|null;
}
