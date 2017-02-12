<?php
require "robertsworkspace/helpers/bootstrap.php";
$router = new Router($routes);
// For Local Testing
$requestURI = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$requestURI = str_replace("RobertsWorkspace/", "", $requestURI);
$requestURI = trim($requestURI, "/");

require $router->direct($requestURI);