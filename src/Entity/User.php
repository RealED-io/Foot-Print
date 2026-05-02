<?php

namespace App\Entity;

// Entity
class User {
    private ?int $id = null;
    private string $name;
    private string $email;
    private string $password;

    public function verifyPassword(string $plain): bool {
        return password_verify($plain, $this->password);
    }

    public function setPassword(string $plain): void {
        $this->password = password_hash($plain, PASSWORD_BCRYPT);
    }

    public function setPasswordHash(string $hash): void {
        $this->password = $hash;
    }

    public function getPassword(): string {
        return $this->password;
    }

    /* GET SET METHODS */
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }
}