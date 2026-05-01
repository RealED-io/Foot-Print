<?php

namespace App\Repository;

use App\Config\Database;
use App\Core\ModelMapper;
use App\Entity\User;
use PDO;

// Repository
class UserRepository {
    public function findByEmail(string $email): ?User {
        $db = Database::connect();

        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return ModelMapper::mapUser($data);
    }

    public function save(User $user): User {
        $db = Database::connect();

        $stmt = $db->prepare("
            INSERT INTO users (name, email, password)
            VALUES (:name, :email, :password)
        ");

        $stmt->execute([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ]);

        $user->id = (int)$db->lastInsertId();

        return $user;
    }
}