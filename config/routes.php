<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

// Single-segment front routes (must be before fallbacks or DashedRoute maps /about -> AboutController)
$routes->connect('/about', ['controller' => 'Fronts', 'action' => 'about']);
$routes->connect('about', ['controller' => 'Fronts', 'action' => 'about']);
$routes->connect('/products', ['controller' => 'Fronts', 'action' => 'products']);
$routes->connect('products', ['controller' => 'Fronts', 'action' => 'products']);
$routes->connect('/projects', ['controller' => 'Fronts', 'action' => 'products']);
$routes->connect('projects', ['controller' => 'Fronts', 'action' => 'products']);
$routes->connect('/suppliers', ['controller' => 'Fronts', 'action' => 'suppliers']);
$routes->connect('suppliers', ['controller' => 'Fronts', 'action' => 'suppliers']);
$routes->connect('/consulting', ['controller' => 'Fronts', 'action' => 'consulting']);
$routes->connect('consulting', ['controller' => 'Fronts', 'action' => 'consulting']);
$routes->connect('/promotions', ['controller' => 'Fronts', 'action' => 'promotions']);
$routes->connect('promotions', ['controller' => 'Fronts', 'action' => 'promotions']);
$routes->connect('/contact-us', ['controller' => 'Fronts', 'action' => 'contact']);
$routes->connect('contact-us', ['controller' => 'Fronts', 'action' => 'contact']);
$routes->connect('/our-services', ['controller' => 'Fronts', 'action' => 'services']);
$routes->connect('our-services', ['controller' => 'Fronts', 'action' => 'services']);

// Home: match '/' and ''
$routes->connect('/', ['controller' => 'Fronts', 'action' => 'index']);
$routes->connect('', ['controller' => 'Fronts', 'action' => 'index']);

// Redirect bare admin path to admin login (support both with/without leading slash)
$routes->connect('/admin', ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'login']);
$routes->connect('admin', ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'login']);

// Admin prefix
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
