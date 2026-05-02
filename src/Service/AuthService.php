<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Entity\User;

// Service / Business Logic for auth
class AuthService {
    private UserRepository $repo;

    public function __construct() {
        $this->repo = new UserRepository();
    }

    public function register(string $name, string $email, string $password): User {
        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);

        return $this->repo->save($user);
    }

    public function login(string $email, string $password): ?User {
        $user = $this->repo->findByEmail($email);

        if (!$user || !$user->verifyPassword($password)) {
            return null;
        }

        return $user;
    }
}