<?php

declare(strict_types=1);

namespace src\infra\repository;

use src\app\model\repository\UserRepository;
use src\app\model\User;
use src\app\model\UserFactory;

final class UserRepositoryInMemory implements UserRepository 
{
    public function create(User $user): void 
    {
    }
    public function findByParams(?string $email = null, ?string $document = null): ?User
    {
        return null;
    }
    public function find(string $id): ?User
    {
        return $this->getUser($id) ?? null;
    }

    private function getUser(string $id): ?User
    {
        $common = UserFactory::create(
            "COMMON",
            "USER",
            "99999999999",
            "common@mail.com",
            "",
            "COMMON",
            "cc8b43ca-207f-4b73-be25-9b8c194ee5f8"
        );
        $shopkeeper = UserFactory::create(
            "SHOPKEEPER",
            "USER",
            "88888888888",
            "shopkeeper@mail.com",
            "",
            "SHOPKEEPER",
            "ea2bcb8d-fd48-483f-8a15-763d40a0c360"
        );
        $users = [
            'cc8b43ca-207f-4b73-be25-9b8c194ee5f8' => $common,
            'ea2bcb8d-fd48-483f-8a15-763d40a0c360' => $shopkeeper
        ];
        return $users[$id] ?? null;
    }
}
