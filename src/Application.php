<?php

declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Routing\RouteBuilder;

class Application extends BaseApplication
{
    public function bootstrap(): void
    {
        parent::bootstrap();
        $this->addPlugin('Migrations');
    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))
            ->add(new RoutingMiddleware($this));

        return $middlewareQueue;
    }

    public function routes(RouteBuilder $routes): void
    {
        $routes->setRouteClass('Cake\Routing\Route\DashedRoute');
        // When App.base is '/', CakePHP strips it so path becomes "about" (no leading slash).
        // Routes with template "about" (scope '') index staticPaths["about"] and match.
        $routes->scope('', function (RouteBuilder $routes) {
            $routes->connect('admin', ['controller' => 'Users', 'action' => 'login', 'prefix' => 'Admin']);
            $routes->connect('about', ['controller' => 'Fronts', 'action' => 'about'], ['_name' => 'about']);
            $routes->connect('products', ['controller' => 'Fronts', 'action' => 'products']);
            $routes->connect('services', ['controller' => 'Fronts', 'action' => 'services']);
            $routes->connect('suppliers', ['controller' => 'Fronts', 'action' => 'services']);
            $routes->connect('consulting', ['controller' => 'Fronts', 'action' => 'consulting']);
            $routes->connect('promotions', ['controller' => 'Fronts', 'action' => 'promotions']);
            $routes->connect('our-services', ['controller' => 'Fronts', 'action' => 'services']);
            $routes->connect('contact-us', ['controller' => 'Fronts', 'action' => 'contact']);
            $routes->connect('blog', ['controller' => 'Blogs', 'action' => 'index']);
        });
        // Home
        $routes->connect('/', ['controller' => 'Fronts', 'action' => 'index']);
        $routes->connect('', ['controller' => 'Fronts', 'action' => 'index']);
        include CONFIG . 'routes.php';
    }
}
