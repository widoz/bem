<?php

/**
 * @param string $path
 *
 * @return string
 */
function rTrimSlash(string $path): string
{
    return rtrim($path, '/');
}

if (!defined('TEST_BASE_DIR')) {
    define('TEST_BASE_DIR', dirname(__DIR__));
}

if (!defined('PROJECT_BASE_DIR')) {
    define('PROJECT_BASE_DIR', dirname(__DIR__, 2));
}

if (!defined('PROJECT_VENDOR_DIR')) {
    define('PROJECT_VENDOR_DIR', rTrimSlash(PROJECT_BASE_DIR) . '/vendor/');
}

// Require Composer Auto-loader.
require_once rTrimSlash(PROJECT_VENDOR_DIR) . '/autoload.php';
