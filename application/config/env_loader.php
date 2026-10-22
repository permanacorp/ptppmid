<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Lightweight Environment (.env) Loader for CodeIgniter 3
 */
if (!function_exists('load_dotenv')) {
    function load_dotenv($path) {
        if (!file_exists($path)) {
            return;
        }
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }
            if (strpos($line, '=') !== false) {
                list($key, $val) = explode('=', $line, 2);
                $key = trim($key);
                $val = trim($val);
                // Strip outer quotes if present
                if ((strpos($val, '"') === 0 && substr($val, -1) === '"') ||
                    (strpos($val, "'") === 0 && substr($val, -1) === "'")) {
                    $val = substr($val, 1, -1);
                }
                putenv("{$key}={$val}");
                $_ENV[$key] = $val;
                $_SERVER[$key] = $val;
            }
        }
    }
}

if (!function_exists('env')) {
    function env($key, $default = null) {
        $val = getenv($key);
        if ($val === false || $val === null || $val === '') {
            if (isset($_ENV[$key]) && $_ENV[$key] !== '') {
                return $_ENV[$key];
            }
            if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') {
                return $_SERVER[$key];
            }
            return $default;
        }
        return $val;
    }
}

// Load .env from root directory safely
$env_root = defined('FCPATH') ? FCPATH : (realpath(dirname(__FILE__) . '/../../') . DIRECTORY_SEPARATOR);
load_dotenv($env_root . '.env');
