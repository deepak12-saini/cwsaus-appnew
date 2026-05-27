<?php

declare(strict_types=1);

$findRoot = function ($root) {
    do {
        if (is_dir($root . '/vendor/cakephp/cakephp')) {
            return $root;
        }
        $root = dirname($root);
        if ($root === dirname($root)) {
            return false;
        }
    } while (true);
};

$root = $findRoot(__DIR__);
if ($root === false) {
    $root = dirname(__DIR__);
}

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

define('ROOT', $root);
define('APP_DIR', 'src');
define('APP', $root . DS . APP_DIR . DS);
define('WEBROOT_DIR', 'webroot');
define('CONFIG', $root . DS . 'config' . DS);
define('TMP', $root . DS . 'tmp' . DS);
define('LOGS', $root . DS . 'logs' . DS);
define('CACHE', $root . DS . 'tmp' . DS . 'cache' . DS);
define('CAKE_CORE_INCLUDE_PATH', $root . DS . 'vendor' . DS . 'cakephp' . DS . 'cakephp');
define('CORE_PATH', CAKE_CORE_INCLUDE_PATH . DS);
define('CAKE', CORE_PATH . 'src' . DS);
define('WWW_ROOT', $root . DS . WEBROOT_DIR . DS);

$autoload = $root . '/vendor/autoload.php';
if (!file_exists($autoload)) {
    die('<h1>Dependencies not installed</h1><p>Run in the project root (e.g. <code>c:\\xampp74\\htdocs\\cwsaus</code>):</p><pre>composer install</pre><p>Requires PHP 7.4+ and <a href="https://getcomposer.org/">Composer</a>.</p>');
}
require $autoload;

if (file_exists($root . '/.env')) {
    (new \josegonzalez\Dotenv\Loader($root . '/.env'))->parse()->putenv(true);
}

require CAKE . 'functions.php';

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Database\TypeFactory;
use Cake\Database\Type\StringType;
use Cake\Datasource\ConnectionManager;
use Cake\Error\ErrorTrap;
use Cake\Error\ExceptionTrap;
use Cake\Log\Log;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\Routing\Router;
use Cake\Http\ServerRequest;
use Cake\Utility\Security;

try {
    Configure::config('default', new PhpConfig());
    Configure::load('app', 'default', false);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

if (file_exists(CONFIG . 'app_local.php')) {
    Configure::load('app_local', 'default');
}

// Subdirectory install (e.g. http://localhost/cwsaus/) — production uses document root so base stays "/"
if (!empty($_SERVER['PHP_SELF'])) {
    $configuredBase = Configure::read('App.base');
    $shouldDetect = $configuredBase === false
        || $configuredBase === null
        || $configuredBase === '/'
        || $configuredBase === '';

    if ($shouldDetect) {
        $scriptDir = dirname(str_replace('\\', '/', $_SERVER['PHP_SELF']));
        if (strpos($scriptDir, '/index.php') !== false) {
            $scriptDir = substr($scriptDir, 0, strpos($scriptDir, '/index.php'));
        }
        $webrootFolder = Configure::read('App.webroot') ?: 'webroot';
        $webrootSuffix = '/' . $webrootFolder;
        if (strlen($scriptDir) >= strlen($webrootSuffix)
            && substr($scriptDir, -strlen($webrootSuffix)) === $webrootSuffix
        ) {
            $scriptDir = dirname($scriptDir);
        }
        if ($scriptDir === '/' || $scriptDir === '.' || $scriptDir === '\\') {
            $scriptDir = '';
        }
        if ($scriptDir !== '' && $scriptDir !== $configuredBase) {
            Configure::write('App.base', $scriptDir);
            $sessionPath = Configure::read('Session.cookiePath');
            if ($sessionPath === '/' || $sessionPath === null || $sessionPath === '') {
                Configure::write('Session.cookiePath', $scriptDir . '/');
            }
        }
    }
}

if (Configure::read('debug')) {
    Configure::write('Cache._cake_model_.duration', '+2 minutes');
    Configure::write('Cache._cake_core_.duration', '+2 minutes');
    Configure::write('Cache._cake_routes_.duration', '+2 seconds');
}

date_default_timezone_set(Configure::read('App.defaultTimezone'));
mb_internal_encoding(Configure::read('App.encoding'));
ini_set('intl.default_locale', Configure::read('App.defaultLocale'));

(new ErrorTrap(Configure::read('Error')))->register();
(new ExceptionTrap(Configure::read('Error')))->register();

// Web and CLI need a route collection before Application::routes() is called (middleware/buildRouteCollection)
\Cake\Routing\Router::setRouteCollection(new \Cake\Routing\RouteCollection());
if (PHP_SAPI === 'cli') {
    if (file_exists(CONFIG . 'bootstrap_cli.php')) {
        require CONFIG . 'bootstrap_cli.php';
    }
}

$fullBaseUrl = Configure::read('App.fullBaseUrl');
if (!$fullBaseUrl) {
    $s = (env('HTTPS') === 'on' || env('HTTP_X_FORWARDED_PROTO') === 'https') ? 's' : '';
    $httpHost = env('HTTP_HOST');
    $fullBaseUrl = isset($httpHost) ? ('http' . $s . '://' . $httpHost) : 'http://localhost';
}
// Use scheme + host only; App.base (/cwsaus) is added by the router — avoids /cwsaus/cwsaus/ URLs
$parsed = parse_url($fullBaseUrl);
if (!empty($parsed['scheme']) && !empty($parsed['host'])) {
    $port = isset($parsed['port']) ? (':' . $parsed['port']) : '';
    $fullBaseUrl = $parsed['scheme'] . '://' . $parsed['host'] . $port;
}
Router::fullBaseUrl(rtrim($fullBaseUrl, '/'));

Cache::setConfig(Configure::consume('Cache'));
ConnectionManager::setConfig(Configure::consume('Datasources'));
if (Configure::check('EmailTransport')) {
    TransportFactory::setConfig(Configure::consume('EmailTransport'));
}
if (Configure::check('Email')) {
    Mailer::setConfig(Configure::consume('Email'));
}
if (Configure::check('Log')) {
    Log::setConfig(Configure::consume('Log'));
}
Security::setSalt(Configure::consume('Security.salt'));

TypeFactory::map('time', StringType::class);
