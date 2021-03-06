<?php

namespace Yolo;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class RouteBuilder
{
    private $index = 0;
    private $routes;

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function get($path, $controller)
    {
        return $this->match($path, $controller, 'GET');
    }

    public function post($path, $controller)
    {
        return $this->match($path, $controller, 'POST');
    }

    public function put($path, $controller)
    {
        return $this->match($path, $controller, 'PUT');
    }

    public function delete($path, $controller)
    {
        return $this->match($path, $controller, 'DELETE');
    }

    public function match($path, $controller, $method = null)
    {
        $name = $this->index++;
        $requirements = $method ? ['_method' => $method] : [];
        $route = new Route($path, ['_controller' => $controller], $requirements);

        $this->routes->add($name, $route);

        return $route;
    }
}
