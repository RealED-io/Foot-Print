<?php

use App\Controller\ActivityController;
use App\Controller\AdminReferenceActivityController;
use App\Controller\AuthController;
use App\Controller\DashboardController;

require_once __DIR__ . '/../init.php';

// Get uri without base path
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$basePath = rtrim($scriptName, '/');
if ($basePath !== '' && $basePath !== '/') {
    $uri = str_replace($basePath, '', $uri);
}

// Get uri (with catch '/') & get HTTP method
$uri = rtrim($uri, '/') ?: '/';
$method = $_SERVER['REQUEST_METHOD'];

// Redirect authenticated users to dashboard when trying to access /login or /register
$guestOnlyRoutes = ['/login', '/register'];
if (isset($_SESSION['user']) && in_array($uri, $guestOnlyRoutes)) {
    header('Location: ' . BASE_URL . '/dashboard');
    exit;
}

/* ROUTES */
$routes = [
    'GET /' => [DashboardController::class, 'index'],
    'GET /dashboard' => [DashboardController::class, 'index'],
    'GET /dashboard/day' => [DashboardController::class, 'dayDetails'],

    'GET /activities' => [ActivityController::class, 'index'],
    'GET /activities/create' => [ActivityController::class, 'create'],
    'POST /activities' => [ActivityController::class, 'store'],
    'POST /activities/delete' => [ActivityController::class, 'delete'],

    'GET /login' => [AuthController::class, 'showLogin'],
    'POST /login' => [AuthController::class, 'login'],

    'GET /register' => [AuthController::class, 'showRegister'],
    'POST /register' => [AuthController::class, 'register'],

    'GET /logout' => [AuthController::class, 'logout'],

    'GET /admin' => [AdminReferenceActivityController::class, 'index'],
    'GET /admin/reference-activities' => [AdminReferenceActivityController::class, 'index'],
    'GET /admin/reference-activities/create' => [AdminReferenceActivityController::class, 'create'],
    'POST /admin/reference-activities' => [AdminReferenceActivityController::class, 'store'],
    'POST /admin/logout' => [AdminReferenceActivityController::class, 'logout'],
    'POST /admin/reference-activities/delete' => [AdminReferenceActivityController::class, 'delete']
];

// Match method + uri to routes map
$key = $method . ' ' . $uri;

if (array_key_exists($key, $routes)) {
    [$controller, $action] = $routes[$key];

    (new $controller())->$action();
    exit;
}

// 404 fallback
http_response_code(404);
require __DIR__ . '/../404.html';