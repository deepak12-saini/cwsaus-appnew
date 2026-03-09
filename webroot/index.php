<?php

/**
 * CakePHP 4 front controller.
 * Point document root to this directory (webroot) or use the project root index.php.
 */

require dirname(__DIR__) . '/config/bootstrap.php';

use App\Application;
use Cake\Http\Server;

$app = new Application(CONFIG);
$server = new Server($app);
$server->emit($server->run());
