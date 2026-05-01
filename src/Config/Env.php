<?php

namespace App\Config;

class Env {
    private static $variables = [];
    private static $loaded = false;

    public static function load($filePath) {
        if (self::$loaded) {
            return;
        }

        if (!file_exists($filePath)) {
            throw new \Exception(".env file not found at: $filePath");
        }

        // Manually parse env file line by line and put to php env
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);

                self::$variables[$key] = $value;
                putenv("$key=$value");
                $_ENV[$key] = $value;
            }
        }

        self::$loaded = true;
    }

    // Get env by key
    public static function get($key, $default = null) {
        if (array_key_exists($key, self::$variables)) {
            return self::$variables[$key];
        }

        $value = getenv($key);

        return $value !== false ? $value : $default;
    }

    // Get env by key, throw exception if not present
    public static function require($key) {
        $value = self::get($key);

        if ($value === null) {
            throw new \Exception("Required environment variable not found: $key");
        }

        return $value;
    }
}