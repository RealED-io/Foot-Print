<?php

require_once __DIR__ . '/../init.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$scriptName = str_replace('\\', DIRECTORY_SEPARATOR, dirname($_SERVER['SCRIPT_NAME']));
$basePath = rtrim($scriptName, DIRECTORY_SEPARATOR);

if ($basePath !== '' && $basePath !== DIRECTORY_SEPARATOR) {
    $uri = str_replace($basePath, '', $uri);
}

$routes = [
    '/' => 'Home page',
    '/test' => 'Test page',
];

if (array_key_exists($uri, $routes)) {
    echo $routes[$uri];
    exit;
}

// 404 fallback
http_response_code(404);
require __DIR__ . '/../404.html';