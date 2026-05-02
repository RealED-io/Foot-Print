<?php

namespace App\Middleware;

use App\Config\Env;

class AdminMiddleware {
    public static function check(): void {

        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
            return;
        }

        // Check submitted password
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_password'])) {
            $envPassword = Env::require('ADMIN_PASSWORD');

            if ($_POST['admin_password'] === $envPassword) {
                $_SESSION['is_admin'] = true;
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit;
            }
        }

        require __DIR__ . '/../../views/admin/login.php';
        exit;
    }
}