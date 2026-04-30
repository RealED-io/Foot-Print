<?php

namespace App\Core;

class Autoloader {
    private static $baseDir;

    public static function register() {
        self::$baseDir = dirname(__DIR__);
        spl_autoload_register([self::class, 'autoload']);
    }

    private static function autoload($className) {

        $prefix = 'App\\';
        $len = strlen($prefix);

        if (strncmp($prefix, $className, $len) !== 0) {
            return;
        }

        $relativeClass = substr($className, $len);

        // Replace namespace separators with directory separators
        $file = self::$baseDir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

        // If the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    }
}