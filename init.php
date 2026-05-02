<?php

require_once __DIR__ . '/src/Core/Autoloader.php';
require_once __DIR__ . '/src/Config/Env.php';

use App\Core\Autoloader;
use App\Config\Env;

Autoloader::register();

session_start();

// Load environment variables, intentional no try catch
Env::load(__DIR__ . '/.env');

define('BASE_URL', '/' . Env::require('APP_NAME') . '/public');

define('IS_LOGGED_IN', isset($_SESSION['user']));

define('HOME_URL', IS_LOGGED_IN ? BASE_URL . '/dashboard' : BASE_URL . '/login');

date_default_timezone_set(Env::get('APP_TIMEZONE', 'UTC'));