<?php
// Router.php
class Router {
    private $routes = [];

    // Register a route with a specific controller and method
    public function addRoute($method, $route, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'route' => $route,
            'controller' => $controller,
            'action' => $action
        ];
    }

    // Match the current request to the registered routes
    public function matchRoute($method, $url) {
        foreach ($this->routes as $route) {
            if ($route['method'] == $method && $route['route'] == $url) {
                return $route;
            }
        }
        return null; // No match found
    }
}
