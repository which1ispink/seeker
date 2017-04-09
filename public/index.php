<?php

// Set work environment
define('ENVIRONMENT', 'development');

// Set error display settings
if (ENVIRONMENT == 'development') {
    ini_set("display_errors", 1);
    error_reporting(E_ALL);
} elseif (ENVIRONMENT == 'production') {
    ini_set("display_errors", 0);
    error_reporting(0);
}

// Change working directory to project root, makes our lives easier when dealing with paths
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Start session
session_start();

// Define vital top-level directory paths
define('BASE_PATH', realpath(__DIR__ . '/../'));
define('APPLICATION_PATH', BASE_PATH . '/application');
define('CONFIG_PATH', BASE_PATH . '/config');
define('CORE_PATH', BASE_PATH . '/core');
define('DATA_PATH', BASE_PATH . '/data');
define('DOCUMENT_ROOT_PATH', BASE_PATH . '/public');

// Setup autoloading
require(BASE_PATH . '/vendor/autoload.php');

// Bootstrap the application and off we go!
try {
    Seeker\Bootstrap::start();
} catch (\Exception $e) {
    die($e->getMessage());
}
