<?php

namespace App\Core;

use App\Entity\User;

class ModelMapper {

    // Maps raw array to User Entity
    public static function mapUser(array $data): User {
        $user = new User();

        $user->id = (int)$data['id'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        return $user;
    }
}