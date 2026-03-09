#!/usr/bin/env php
<?php
/**
 * CakePHP 4 console entry point (run with: php bin/cake.php ...)
 */
$root = dirname(__DIR__);
require $root . '/config/bootstrap.php';

use App\Application;
use Cake\Console\CommandRunner;

$app = new Application(CONFIG);
$runner = new CommandRunner($app);
exit($runner->run($GLOBALS['argv'] ?? []));
