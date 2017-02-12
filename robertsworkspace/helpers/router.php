<?php

class Router {

    private $routes = [];

    public function define($routes) {
        $this->routes = $routes;
    }

    public function direct($requestURI) {
        if (array_key_exists($requestURI, $this->routes)) {
            return $this->routes[$requestURI];
        }
        throw new exception('Invalid URL:' . $requestURI);
    }

    public function __construct($routes) {
        $this->routes = $routes;
    }

}
