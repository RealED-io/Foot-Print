<?php

namespace App\Controller;

use App\Middleware\AuthMiddleware;

class DashboardController {
    public function index() {
        // Require auth
        AuthMiddleware::check();

        require __DIR__ . '/../../views/dashboard/index.php';
    }
}