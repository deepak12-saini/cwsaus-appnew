<?php
/**
 * CakePHP 4 path constants.
 */
use Cake\Core\Configure;

$ds = DIRECTORY_SEPARATOR;

/**
 * Root directory.
 */
if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}

/**
 * Application directory.
 */
if (!defined('APP_DIR')) {
    define('APP_DIR', 'src');
}

/**
 * Web root directory.
 */
if (!defined('WWW_ROOT')) {
    define('WWW_ROOT', ROOT . $ds . 'webroot' . $ds);
}

/**
 * Path to the application's directory.
 */
if (!defined('APP')) {
    define('APP', ROOT . $ds . APP_DIR . $ds);
}

/**
 * Path to the config directory.
 */
if (!defined('CONFIG')) {
    define('CONFIG', ROOT . $ds . 'config' . $ds);
}

/**
 * Path to the logs directory.
 */
if (!defined('LOGS')) {
    define('LOGS', ROOT . $ds . 'logs' . $ds);
}

/**
 * Path to the cache directory.
 */
if (!defined('CACHE')) {
    define('CACHE', ROOT . $ds . 'tmp' . $ds . 'cache' . $ds);
}

/**
 * Path to the temporary files directory.
 */
if (!defined('TMP')) {
    define('TMP', ROOT . $ds . 'tmp' . $ds);
}

/**
 * Path to the tests directory.
 */
if (!defined('TESTS')) {
    define('TESTS', ROOT . $ds . 'tests' . $ds);
}
