<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

// Single-segment routes defined in Application.php (scope '') for path "about" etc.
// Home: match '/', '' and /cwsaus/
$routes->connect('/', ['controller' => 'Fronts', 'action' => 'index']);
$routes->connect('', ['controller' => 'Fronts', 'action' => 'index']);
$routes->connect('/cwsaus', ['controller' => 'Fronts', 'action' => 'index']);
$routes->connect('/cwsaus/', ['controller' => 'Fronts', 'action' => 'index']);
$routes->connect('/our-services', ['controller' => 'Fronts', 'action' => 'services']);

// Admin prefix: path 'admin' (no leading slash) to match when App.base is '/'
$routes->prefix('Admin', ['path' => 'admin'], function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Users', 'action' => 'login']);
    $routes->fallbacks(DashedRoute::class);
});

// /admin redirect handled by Application.php scope + prefix above
$routes->connect('/user-area', ['controller' => 'Fronts', 'action' => 'userArea']);
$routes->connect('/pricing', ['controller' => 'Fronts', 'action' => 'pricing']);
$routes->connect('/policies', ['controller' => 'Fronts', 'action' => 'policies']);
$routes->connect('/blog', ['controller' => 'Blogs', 'action' => 'index']);
$routes->connect('/blog/:slug', ['controller' => 'Blogs', 'action' => 'index'], ['pass' => ['slug']]);
$routes->connect('/blogs/detail/:slug', ['controller' => 'Blogs', 'action' => 'detail'], ['pass' => ['slug']]);
$routes->connect('/solar-home', ['controller' => 'Fronts', 'action' => 'solarHome']);
$routes->connect('/solar-business', ['controller' => 'Fronts', 'action' => 'solarBusiness']);
$routes->connect('/solar-types', ['controller' => 'Fronts', 'action' => 'solarTypes']);
$routes->connect('/solar-calculator', ['controller' => 'Fronts', 'action' => 'calculator']);
$routes->connect('/final-calculation', ['controller' => 'Fronts', 'action' => 'calNext']);
$routes->connect('/thank-you', ['controller' => 'Fronts', 'action' => 'thankYou']);
$routes->connect('/quick-notes/*', ['controller' => 'Quicks', 'action' => 'index']);
$routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

$routes->fallbacks(DashedRoute::class);
