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
        // Home page first so / and '' always match before fallbacks
        $routes->connect('/', ['controller' => 'Fronts', 'action' => 'index']);
        $routes->connect('', ['controller' => 'Fronts', 'action' => 'index']);
        include CONFIG . 'routes.php';
    }
}
