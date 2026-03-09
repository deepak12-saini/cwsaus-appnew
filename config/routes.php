<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

// Home: match '/', '' and /cwsaus/ (in case base path is not stripped)
$routes->connect('/', ['controller' => 'Fronts', 'action' => 'index']);
$routes->connect('', ['controller' => 'Fronts', 'action' => 'index']);
$routes->connect('/cwsaus', ['controller' => 'Fronts', 'action' => 'index']);
$routes->connect('/cwsaus/', ['controller' => 'Fronts', 'action' => 'index']);

// Admin prefix: /admin/* maps to App\Controller\Admin\*Controller
$routes->prefix('Admin', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Users', 'action' => 'login']);
    $routes->fallbacks(DashedRoute::class);
});

// Redirect /admin to admin login
$routes->connect('/admin', ['controller' => 'Users', 'action' => 'login', 'prefix' => 'Admin']);
$routes->connect('/about', ['controller' => 'Fronts', 'action' => 'about']);
$routes->connect('/consulting', ['controller' => 'Fronts', 'action' => 'consulting']);
$routes->connect('/promotions', ['controller' => 'Fronts', 'action' => 'promotions']);
$routes->connect('/suppliers', ['controller' => 'Fronts', 'action' => 'suppliers']);
$routes->connect('/products', ['controller' => 'Fronts', 'action' => 'products']);
$routes->connect('/our-services', ['controller' => 'Fronts', 'action' => 'services']);
$routes->connect('/user-area', ['controller' => 'Fronts', 'action' => 'userArea']);
$routes->connect('/pricing', ['controller' => 'Fronts', 'action' => 'pricing']);
$routes->connect('/policies', ['controller' => 'Fronts', 'action' => 'policies']);
$routes->connect('/blog', ['controller' => 'Blogs', 'action' => 'index']);
$routes->connect('/blog/:slug', ['controller' => 'Blogs', 'action' => 'index'], ['pass' => ['slug']]);
$routes->connect('/blogs/detail/:slug', ['controller' => 'Blogs', 'action' => 'detail'], ['pass' => ['slug']]);
$routes->connect('/contact-us', ['controller' => 'Fronts', 'action' => 'contact']);
$routes->connect('/solar-home', ['controller' => 'Fronts', 'action' => 'solarHome']);
$routes->connect('/solar-business', ['controller' => 'Fronts', 'action' => 'solarBusiness']);
$routes->connect('/solar-types', ['controller' => 'Fronts', 'action' => 'solarTypes']);
$routes->connect('/solar-calculator', ['controller' => 'Fronts', 'action' => 'calculator']);
$routes->connect('/final-calculation', ['controller' => 'Fronts', 'action' => 'calNext']);
$routes->connect('/thank-you', ['controller' => 'Fronts', 'action' => 'thankYou']);
$routes->connect('/quick-notes/*', ['controller' => 'Quicks', 'action' => 'index']);
$routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

$routes->fallbacks(DashedRoute::class);
