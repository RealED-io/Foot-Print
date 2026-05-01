<?php

namespace App\Middleware;

// Redirects unauthenticated users to login
class AuthMiddleware {
    public static function check(): void {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }
}