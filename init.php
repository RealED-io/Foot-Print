<?php

require_once __DIR__ . '/src/Core/Autoloader.php';

use App\Core\Autoloader;
use App\Config\Env;

Autoloader::register();

// Load environment variables, intentional no try catch
Env::load(__DIR__ . '/.env');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set(Env::get('APP_TIMEZONE', 'UTC'));
