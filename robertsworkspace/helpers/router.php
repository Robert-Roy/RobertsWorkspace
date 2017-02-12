<?php
class Router {

    private $routes = [];

    public function define($routes) {
        $this->routes = $routes;
    }

    public function direct($requestURI) {
        if (array_key_exists($requestURI, $this->routes)) {
            //require "analytics/analytics.php";
            $analytics = new Analytics();
            $analytics->recordView($requestURI);
            return $this->routes[$requestURI];
        }
        throw new exception('Invalid URL:' . $requestURI);
    }

    public function __construct($routes) {
        $this->routes = $routes;
    }
    public function trimURI($URI){
        $URI = parse_url($URI, PHP_URL_PATH);
        $URI = str_replace("robertsworkspace", "", $URI); //this line only applies during local testing
        $URI = str_replace("RobertsWorkspace", "", $URI); //this line only applies during local testing
        $URI = trim($URI, "/");
        return $URI;
    }

}