<?php

namespace App\Entity;

// Entity
class User {
    public ?int $id = null;
    public string $name;
    public string $email;
    public string $password;

    public function verifyPassword(string $plain): bool {
        return password_verify($plain, $this->password);
    }

    public function setPassword(string $plain): void {
        $this->password = password_hash($plain, PASSWORD_BCRYPT);
    }
}