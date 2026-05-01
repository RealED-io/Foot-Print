<?php

namespace App\Controller;

use App\Service\AuthService;

class AuthController {
    private AuthService $auth;

    public function __construct() {
        $this->auth = new AuthService();
    }

    public function showLogin() {
        require __DIR__ . '/../../views/auth/login.php';
    }

    public function showRegister() {
        require __DIR__ . '/../../views/auth/register.php';
    }

    // Send POST request to register
    public function register() {
        $user = $this->auth->register(
            $_POST['name'],
            $_POST['email'],
            $_POST['password']
        );

        $_SESSION['user'] = $user;

        header('Location: ' . BASE_URL . '/dashboard');
        exit;
    }

    // Send POST request to login
    public function login() {
        $user = $this->auth->login(
            $_POST['email'],
            $_POST['password']
        );

        if (!$user) {
            echo "Invalid credentials";
            return;
        }

        $_SESSION['user'] = $user;

        header('Location: ' . BASE_URL . '/dashboard');
        exit;
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
    }
}