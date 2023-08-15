<?php

namespace src\infra\repository;

use src\model\repository\UserRepository;
use src\model\User;

final class UserRepositoryInMemory implements UserRepository 
{
    public function create(User $user): void 
    {
    }
    public function find(?string $email = null, ?string $document = null): User|null 
    {
        return null;
    }
}
